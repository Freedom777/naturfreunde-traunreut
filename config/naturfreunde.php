<?php

return [
    # Какие года считаются юбилейными для членства в Naturfreunde
    'jubilee_years' => array_map(
        'intval',
        explode(',', env('JUBILEE_YEARS', '10,25,30,40,50,75'))
    ),
];
