<?php

namespace Daun\StatamicGraphQLAlternateLocales\GraphQL;

use Statamic\Entries\Entry;
use Statamic\Facades\GraphQL;

class EntryLocaleType extends \Rebing\GraphQL\Support\Type
{
    const NAME = 'EntryLocale';

    protected $attributes = [
        'name' => self::NAME,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => GraphQL::nonNull(GraphQL::id()),
                'resolve' => fn (Entry $entry) => $entry->id(),
            ],
            'locale' => [
                'type' => GraphQL::nonNull(GraphQL::string()),
                'resolve' => fn (Entry $entry) => $entry->locale(),
            ],
            'current' => [
                'type' => GraphQL::nonNull(GraphQL::boolean()),
                'resolve' => fn ($entry) => $entry->locale() === $entry->getSupplement('current_locale'),
            ],
            'slug' => [
                'type' => GraphQL::nonNull(GraphQL::string()),
                'resolve' => fn (Entry $entry) => $entry->slug(),
            ],
            'url' => [
                'type' => GraphQL::nonNull(GraphQL::string()),
                'resolve' => fn (Entry $entry) => $entry->url(),
            ],
            'uri' => [
                'type' => GraphQL::nonNull(GraphQL::string()),
                'resolve' => fn (Entry $entry) => $entry->uri(),
            ],
            'title' => [
                'type' => GraphQL::nonNull(GraphQL::string()),
                'resolve' => fn (Entry $entry) => $entry->augmentedValue('title'),
            ],
            'permalink' => [
                'type' => GraphQL::string(),
                'resolve' => fn (Entry $entry) => $entry->absoluteUrl(),
            ],
            'published' => [
                'type' => GraphQL::nonNull(GraphQL::boolean()),
                'resolve' => fn (Entry $entry) => $entry->published(),
            ],
            'private' => [
                'type' => GraphQL::nonNull(GraphQL::boolean()),
                'resolve' => fn (Entry $entry) => $entry->private(),
            ],
            'status' => [
                'type' => GraphQL::nonNull(GraphQL::string()),
                'resolve' => fn (Entry $entry) => $entry->status(),
            ],
        ];
    }
}
