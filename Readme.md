# Pixiucz\AresFinder
```php
$results = $AresFinder->findByName("Pixiu");
$results2 = $AresFinder->findByIco("05307503");
```
### Response format
- Natively returns PHP array, after json encoding looks like this: 
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