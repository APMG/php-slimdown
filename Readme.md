# Slimdown

Slimdown is a simple library to allow you to easily add static pages to your app
via a folder full of Markdown files.

Justin Heideman conceived and built the original version.

[![Build Status](https://travis-ci.org/APMG/php-slimdown.svg?branch=master)](https://travis-ci.org/APMG/php-slimdown)

## Installation

Add this line to your application's composer.json:

```json
{
    "require": {
        "apmg/slimdown": "*"
    }
}
```

And then execute:

    $ composer update


## Usage

To add to your app, in the method that handles the static pages, add code to
load the page.

    class SlimdownController extends ApplicationController {
      public function show() {
        $page = \Slimdown\Page::find($params['slug']);
      }
    }

Then add a view for the show action.

    {$page->body}


Add a globbing route to direct all unhandled requests to your controller. Make
sure that it doesn't supersede other routes.

Finally, add configuration to set the path to your pages. This could be done as
part of a bootstrapping routine.

    \Slimdown\Slimdown::config(function($config){
      $config->set_location('lib/pages');
    });


## General notes

The use case for us is that we have a distinct repo containing the markdown (and
some other files) which is editable by producers. This is autodeployed to a
location on our servers which is accessible from our PHP app.


## Development

After checking out the repo, run `composer install` to install dependencies.


## Contributing

1. Fork it ( https://github.com/apmg/php-slimdown/fork )
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create a new Pull Request
