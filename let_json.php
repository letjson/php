<?php

//namespace letjson;

/**
 * @param string $url
 * @return mixed
 */
function let_json($url, $callback = null, $associative = false)
{
    $file = file_get_contents($url, true);
    $json = json_decode($file, $associative);

    if (is_callable($callback)) {
        $callback($json);
    }

    return $json;
}


/**
 * Class LetJson
 */
class LetJson
{
    /** @var array|mixed */
    public $json = [];

    function __construct($url)
    {
        $this->json = let_json($url);
    }

    /**
     * @return mixed
     */
    function first()
    {
        return $this->json[0];
    }

    /**
     * @param $callback
     */
    function each($callback)
    {
        foreach ($this->json as $item) {
            $callback($item);
        }
    }
}