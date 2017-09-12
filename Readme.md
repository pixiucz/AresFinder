# Pixiucz\AresFinder
### Register in October CMS
- `composer require pixiucz/ares-finder`
- Add this to your `Plugin.php`
```php
public function boot()
{
    ...
    $this->app->register(\Pixiucz\AresFinder\AresFinderServiceProvider::class)
    ...
}
```
### Usage
```php
// Can be injected through constructor or by using service provider
$AresFinder = app('AresFinder');
$results = $AresFinder->findByName("Pixiu");
$results2 = $AresFinder->findByIco("05307503");
```
### Response format
- Returns Laravel **Collection** (even in case of single response) 
```json
    {
        "Name": "Pixiu s.r.o.",
        "Origin": "2016-08-22",
        "Validity": "2017-09-08",
        "Legal form of bussiness": "Společnost s ručením omezeným",
        "ICO": "05307503",
        "Address": {
            "State code": "203",
            "District": "Brno-město",
            "City": "Brno",
            "Street": "Příkop",
            "House number": "843",
            "Orientation number": "4",
            "Zip": "60200"
        }
    }
```
