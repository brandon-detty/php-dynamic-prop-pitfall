<?php

namespace BrandonDetty\DynamicPropPitfall;

class DynamicPropMemTest
{
    public static $test_size = 10 ** 5;

    /** returns memory used (MiB) to create self::$test_size objects **/
    private static function memUsage(
        string $class,
        bool $set_dynamic_property = false
    ) {
        $generator = __NAMESPACE__ . '\\' . "${class}Generator";
        $objs = [];
        gc_collect_cycles();
        $start_mem = memory_get_usage();
        for ($i = 0; $i < self::$test_size; ++$i) {
            $objs[] = $generator::getObject();
            if ($set_dynamic_property) {
                $objs[$i]->dynamic = true;
            }
        }
        $bytes = memory_get_usage() - $start_mem;
        return round($bytes / 1024 ** 2, 2);
    }

    private static function timeDiff(int $hr_start_time)
    {
        return round((hrtime(true) - $hr_start_time) / 10 ** 9, 3);
    }

    private static function testClass(string $class)
    {
        $start = hrtime(true);
        $mem = self::memUsage($class, false);
        $time = self::timeDiff($start);

        $start = hrtime(true);
        $mem_dynamic = self::memUsage($class, true);
        $time_dynamic = self::timeDiff($start);

        $mem_penalty = round($mem_dynamic / $mem, 1);
        $time_penalty = round($time_dynamic / $time, 1);

        $reflection = new \ReflectionClass(__NAMESPACE__ . "\\$class");
        $props_count = count($reflection->getProperties(\ReflectionProperty::IS_PUBLIC));

        echo <<<EOT
          Testing $class (w/ $props_count public properties)
            No Dynamic Props: $mem MiB, $time seconds
            w/ Dynamic Props: $mem_dynamic MiB, $time_dynamic seconds
            Memory Penalty: ${mem_penalty}x
            Time Penalty: ${time_penalty}x

        EOT;
    }

    public static function run()
    {
        self::testClass('MunicipalityData');
        self::testClass('PersonData');
    }
}
