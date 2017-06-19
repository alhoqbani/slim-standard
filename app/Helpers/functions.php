<?php


function logThis($type, $data = null)
{
    $file = ROOT . 'Storage/logs/applog.txt';
    if ( ! file_exists($file)) {
        exec('mkdir -p ' . ROOT . 'Storage/logs');
        exec('touch ' . $file);
    }
    $resource = fopen(ROOT . 'Storage/logs/applog.txt', 'a');
    
    $content = "{$type} \t " . \Carbon\Carbon::now()->toDateTimeString() . PHP_EOL;
    
    $content .= http_build_query($data);
    
    fwrite($resource, $content . PHP_EOL . PHP_EOL);
    
    fclose($resource);
}

//function extract_data($data)
//{
//    $content = '';
//    if (is_array($data)) {
//        foreach ($data as $key => $value) {
//            if (is_array($value) ) {
//                extract_data($value);
//                continue;
//            }
//            if (is_array($key) ) {
//                extract_data($key);
//                continue;
//            }
//            $content .= "KEY: {$key} \t | {$value} " . PHP_EOL;
//        }
//    } else {
//        $content .= "DATA:\t {$data}" . PHP_EOL;
//    }
//
//        return $content;
//} //

function extract_data($data) {
    if (is_array($data)) {
        $content;
    }
}
