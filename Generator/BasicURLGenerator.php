<?php

class BasicURLGenerator implements URLGenerator
{
    public function generateURL(string $url = '', array $additional_parameters = []): string
    {
        $parsed_Url = parse_url($url);
        $provided_params    = $this->getParamsFromQuery($parsed_Url); 
        $query_params       = $this->addNewParamIntoQueryPart($provided_params, $additional_parameters);

        // Rebuild the URL
        $generated_Url = $this->restoreUrl($parsed_Url);
        $generated_Url = $this->addQueryToURL($generated_Url, $query_params);
        $generated_Url = $this->addFragment($generated_Url, $parsed_Url);
        return $generated_Url;
    }

    private function restoreUrl( array $parsed_url_parts = []) : string 
    {
        $response = '';
        $response = $parsed_url_parts['scheme'] . '://' . $parsed_url_parts['host'];
        $response.= !empty($parsed_url_parts['path']) ? $parsed_url_parts['path'] : '';
        return  $response;
    }

    private function addFragment(string $url = '',  array $parsed_url_parts = []): string 
    {
        $response = $url; 
        $response.= !empty($parsed_url_parts['fragment']) ? '#'.$parsed_url_parts['fragment'] : '';
        return  $response;
    }

    private function addQueryToURL(string $url = '',  array $query_parts = []): string 
    {
        if(empty($query_parts)) {
            return  $url;
        }

        $query = http_build_query($query_parts);
        $query = urldecode( $query );

        $url.= '?'. $query;
        return  $url;
    }

    private function getParamsFromQuery(array $parsed_url_parts = []) : array
    {
        $params = []; 
        if(empty($parsed_url_parts['query'])){
            return $params;
        }

        $parsed_url_parts['query'] = $parsed_url_parts['query'];

        $params = explode('&',$parsed_url_parts['query']);
        if(count($params) === 0){
            return $params;
        }

        //create 2 dimmentional multi-array where child array structure:  first member is a param name and second member is a param value
        $_params_arr = array_map(
            fn($item) => explode('=', $item),
            $params 
        );
        
        // Convert the resulting array to associative
        $params = array_combine(array_column($_params_arr, 0), array_column($_params_arr, 1));
        return $params;
    }

    protected function addNewParamIntoQueryPart(array $provided_params = [], array $additional_parameters = []) : array
    {
        //Reduce additional parameters list to prevent duplication
        foreach( $provided_params as $key=>$value) 
        {
           if(array_key_exists( $key, $additional_parameters)){
                unset($additional_parameters[$key]);
           }
        }

        //all additional parameters already used, we have Nothing new to add, so returning original parameters only 
        if(count($additional_parameters) == 0){
            return $provided_params;
        }
        
        // Choose a random key from the array
        $randomKey = array_rand($additional_parameters);

        //add single random parameter from list of additional parameter to original list
        $provided_params[$randomKey] = $additional_parameters[$randomKey];

        return $provided_params;
    }


}