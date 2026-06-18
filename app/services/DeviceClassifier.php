<?php

class DeviceClassifier
{
    public static function detect($hostname, $vendor, $ports)
    {
        $name = strtolower($hostname);

        if (strpos($name, 'router') !== false)
            return 'Router';

        if (strpos($name, 'printer') !== false)
            return 'Printer';

        if (in_array(9100, $ports))
            return 'Printer';

        if (in_array(554, $ports))
            return 'Camera';

        if (in_array(80, $ports) || in_array(443, $ports))
            return 'Server';

        return 'Client';
    }
}
