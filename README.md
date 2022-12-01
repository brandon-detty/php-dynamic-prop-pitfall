This repo serves as a reference point for a
 [blog post](https://babypengu.in/blog/tech/php-efficiently-storing-object-data/)
 on avoiding memory bloat when working with large numbers of objects in PHP.

After running `composer install`, `composer exec run` (or `php bin/run.php`)
will execute a simple benchmark. For two classes, MunicipalityData and
PersonData, the script generates 100k objects twice, with the second pass adding
a dynamic property (i.e. one not contained in the class definition) to each.
 PersonData has significantly more properties than MunicipalityData in order to
demonstrate another way in which this issue scales. Example output using PHP
8.1.121:
```
  Testing MunicipalityData (w/ 3 public properties)
    No Dynamic Props: 14.15 MiB, 0.018 seconds
    w/ Dynamic Props: 49.02 MiB, 0.032 seconds
    Memory Penalty: 3.5x
    Time Penalty: 1.8x
  Testing PersonData (w/ 32 public properties)
    No Dynamic Props: 65.05 MiB, 0.048 seconds
    w/ Dynamic Props: 314.52 MiB, 0.138 seconds
    Memory Penalty: 4.8x
    Time Penalty: 2.9x
```
