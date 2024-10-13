<?php

namespace Daun\StatamicGraphQLAlternateLocales;

use Daun\StatamicGraphQLAlternateLocales\GraphQL\EntryLocaleType;
use Statamic\Entries\Entry;
use Statamic\Facades\GraphQL;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function bootAddon(): void
    {
        if (! config('statamic.graphql.enabled')) {
            return;
        }

        GraphQL::addType(EntryLocaleType::class);

        GraphQL::addField('EntryInterface', 'locales', function () {
            return [
                'type' => GraphQL::listOf(GraphQL::type(EntryLocaleType::NAME)),
                'args' => [
                    'unpublished' => ['type' => GraphQL::boolean()]
                ],
                'resolve' => function (Entry $entry, $args) {
                    $locale = $entry->locale();
                    return collect($entry->sites())
                        ->map(fn ($site) => $entry->in($site))
                        ->filter()
                        ->filter(fn (Entry $entry) => $entry->status() === 'published' || ($args['unpublished'] ?? false))
                        ->map(fn (Entry $entry) => $entry->setSupplement('current_locale', $locale))
                        ->all();
                }
            ];
        });
    }
}
