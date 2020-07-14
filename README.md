# Laravel fullcalendar component
Notice: This is a fork of  Edofre/laravel-fullcalendar package, which I have grown to love and use. My intention is to bring it up to code compliance for the newer versions of Laravel. 
This version will now install adding the required NPM package directly without Bower. We are still under going testing on this package.
DO NOT USE THIS CODE!!! See https://github.com/Edofre/laravel-fullcalendar for the original package.
## Warning
DO NOT USE THIS CODE!!! See https://github.com/Edofre/laravel-fullcalendar for the original package.

## Use with Laravel/Homestead
This package will NOT install properly under Laravel/Homestead at this time because of VirtualBox Issues.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install, either run

```
$ php composer.phar require walterbamert/laravel-fullcalendar
```

or add

```
"walterbamert/laravel-fullcalendar": "^3.1"
```

to the ```require``` section of your `composer.json` file.

### Note 
The fxp/composer-asset plugin is no longer required for this package to install properly.
We have converted the package to use Foxy. This plugin enables you to download NPM packages through composer and is included as part of this package.
You can find more info on this page: [https://github.com/fxpio/foxy](https://github.com/fxpio/foxy).

## Configuration

Add the ServiceProvider to your config/app.php
```php
'providers' => [
        ...
        walterbamert\Fullcalendar\FullcalendarServiceProvider::class,
    ],
```

And add the facade
```php
'aliases' => [
        ...
        'Fullcalendar' => walterbamert\Fullcalendar\Facades\Fullcalendar::class,
    ],
```

Publish assets and configuration files
```
php artisan vendor:publish --tag=config
php artisan vendor:publish --tag=fullcalendar
```

### Manually loading script files
By setting the include_scripts option in the config/.env file to false the scripts will not be included when generating the calendar.
If you want to manually include the scripts you can call the following static function in your header/footer/etc.
```
    \walterbamert\Fullcalendar\Fullcalendar::renderScriptFiles();
```

### Example
Below is an example of a controller action configuring the calendar
```php
    public function index()
    {
        // Generate a new fullcalendar instance
        $calendar = new \walterbamert\Fullcalendar\Fullcalendar();

        // You can manually add the objects as an array
        $events = $this->getEvents();
        $calendar->setEvents($events);
        // Or you can add a route and return the events using an ajax requests that returns the events as json
        $calendar->setEvents(route('fullcalendar-ajax-events'));

        // Set options
        $calendar->setOptions([
            'locale'      => 'nl',
            'weekNumbers' => true,
            'selectable'  => true,
            'defaultView' => 'agendaWeek',
            // Add the callbacks
            'eventClick' => new \walterbamert\Fullcalendar\JsExpression("
                function(event, jsEvent, view) {
                    console.log(event);
                }
            "),
            'viewRender' => new \walterbamert\Fullcalendar\JsExpression("
                function( view, element ) {
                    console.log(\"View \"+view.name+\" rendered\");
                }
            "),
        ]);

        // Check out the documentation for all the options and callbacks.
        // https://fullcalendar.io/docs/

        return view('fullcalendar.index', [
            'calendar' => $calendar,
        ]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function ajaxEvents(Request $request)
    {
        // start and end dates will be sent automatically by fullcalendar, they can be obtained using:
        // $request->get('start') & $request->get('end')
        $events = $this->getEvents();
        return json_encode($events);
    }

    /**
     * @return array
     */
    private function getEvents()
    {
        $events = [];
        $events[] = new \walterbamert\Fullcalendar\Event([
            'id'     => 0,
            'title'  => 'Rest',
            'allDay' => true,
            'start'  => Carbon::create(2016, 11, 20),
            'end'    => Carbon::create(2016, 11, 20),
        ]);

        $events[] = new \walterbamert\Fullcalendar\Event([
            'id'    => 1,
            'title' => 'Appointment #' . rand(1, 999),
            'start' => Carbon::create(2016, 11, 15, 13),
            'end'   => Carbon::create(2016, 11, 15, 13)->addHour(2),
        ]);

        $events[] = new \walterbamert\Fullcalendar\Event([
            'id'               => 2,
            'title'            => 'Appointment #' . rand(1, 999),
            'editable'         => true,
            'startEditable'    => true,
            'durationEditable' => true,
            'start'            => Carbon::create(2016, 11, 16, 10),
            'end'              => Carbon::create(2016, 11, 16, 13),
        ]);

        $events[] = new \walterbamert\Fullcalendar\Event([
            'id'               => 3,
            'title'            => 'Appointment #' . rand(1, 999),
            'editable'         => true,
            'startEditable'    => true,
            'durationEditable' => true,
            'start'            => Carbon::create(2016, 11, 14, 9),
            'end'              => Carbon::create(2016, 11, 14, 10),
            'backgroundColor'  => 'black',
            'borderColor'      => 'red',
            'textColor'        => 'green',
        ]);
        return $events;
    }
```


You can then render the calendar by generating the HMTL and scripts
```php
    {!! $calendar->generate() !!}
```


## Tests

Run the tests by executing the following command:
```
composer test
```
