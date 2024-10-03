# Statamic GraphQL Alternate Locales

**List alternate locales of entries in Statamic GraphQL queries.**

This addon provides a simple way of querying alternate languages of entries in GraphQL. Mainly
useful for frontend language switches.

## Installation

```sh
composer require daun/statamic-graphql-alternate-locales
```

## Usage

After installation, you can list all locales of an entry from the new `locales` field. It requires
selecting the specific subfields to return. See below for a list of all supported subfields.

```graphql
{
  page: entry(
    collection: "pages"
    slug: "about"
    filter: { locale: "en" }
  ) {
    slug
    title
    locale
    locales {
      locale
      slug
      title
    }
  }
}
```

The above query would result in the following data:

```json
{
  "slug": "about",
  "title": "About",
  "locale": "en",
  "locales": [
    {
      "locale": "de",
      "slug": "ueber-uns",
      "title": "Über uns"
    },
    {
      "locale": "en",
      "slug": "about",
      "title": "About"
    }
  ]
}
```

## Publish status

By default, the `locales` field only returns entries in published locales. To include all locales
regardless of publish status, set the `unpublished` arg to `false`:

```graphql
locales (unpublished: true) {
  locale
  slug
  title
}
```

## Available subfields

| Subfield      | Value      |
|---------------|---------------|
| `id` | `$entry->id()` |
| `locale` | `$entry->locale()` |
| `current` | `$entry->locale()` === `locale` filter of query |
| `slug` | `$entry->slug()` |
| `url` | `$entry->url()` |
| `uri` | `$entry->uri()` |
| `permalink` | `$entry->absoluteUrl()` |
| `published` | `$entry->published()` |
| `private` | `$entry->private()` |
| `status` | `$entry->status()` |
| `title` | `$entry->get('title')` |

## License

[MIT](https://opensource.org/licenses/MIT)
