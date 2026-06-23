<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * Site settings repository.
 *
 * Settings are stored one DB row per top-level "group" (homepage, about,
 * contact, footer, nav, site), each holding a structured JSON array. Reads use
 * dot-notation (e.g. "homepage.hero.headline") against the merged, cached map.
 */
class Settings
{
    protected ?array $items = null;

    public function all(): array
    {
        if ($this->items === null) {
            $this->items = Cache::rememberForever('settings.all', function () {
                return Setting::all()->mapWithKeys(fn (Setting $s) => [$s->key => $s->value])->all();
            });
        }

        return $this->items;
    }

    /** Get a setting by dot-path, with a fallback default. */
    public function get(string $key, mixed $default = null): mixed
    {
        return Arr::get($this->all(), $key, $default);
    }

    /** Write a setting at any dot-path; persists the affected group row. */
    public function set(string $key, mixed $value): void
    {
        $group = strtok($key, '.');

        if (! str_contains($key, '.')) {
            $data = $value;
        } else {
            $rest = substr($key, strlen($group) + 1);
            $data = $this->get($group, []);
            if (! is_array($data)) {
                $data = [];
            }
            Arr::set($data, $rest, $value);
        }

        Setting::updateOrCreate(['key' => $group], ['value' => $data]);
        $this->flush();
    }

    /** Write many dot-path => value pairs. */
    public function setMany(array $pairs): void
    {
        foreach ($pairs as $key => $value) {
            $this->set($key, $value);
        }
    }

    /** Clear the in-memory + cache copy so the next read is fresh. */
    public function flush(): void
    {
        $this->items = null;
        Cache::forget('settings.all');
    }
}
