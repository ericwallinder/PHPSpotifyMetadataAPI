<?php
/**
 * A singelton class that communicates with the metadata services; search
 * and lookup.
 * 
 * @author <a href="mailto:eric@wallinder.me>Eric Wallinder</a>
 */
class MetadataController {
    const kSearchUrl = "http://ws.spotify.com/search/1/";
    const kLookupUrl = "http://ws.spotify.com/lookup/1/";    
    
    /** One unique instrance */
    private static $fInstance;

    /** Singelton class. */
    private function __construct() {}

    /**
     * Get new instance of this object.
     */
    public static function instance() {
        if ( isset(self::$fInstance) == false ) {
            $aClass = __CLASS__;
            self::$fInstance = new $aClass;
        }
        return self::$fInstance;
    }

    /**
     * Prevent clone since this is a singelton 
     */
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    /**
     * Using the search service
     * 
     * @param pMethod	String	album, artist, or track.
     * @param pQuery	String	a query string.
     * @param pFormat	String	json or xml.
     */
    public function search($pMethod, $pQuery, $pFormat="json") {
		$aURL = self::kSearchUrl . $pMethod . "." . $pFormat . "?q=" . $pQuery;
		return $this->request($aURL);
    } 

    /**
     * Using the lookup service
     * 
     * @param pURI 		String	a Spotify URI.
     * @param pFormat 	String	json or xml.
     */
    public function lookup($pURI, $pFormat="json") {
    	$aURL = self::kLookupUrl . "." . $pFormat . "?uri=" .  $pURI;    	
    	return $this->request($aURL);
    }

    /**
     * Sends an HTTP request to the specified URL.
     * 
     * @param pURL	String	the URL the is requested.
     * @throws Exception if the HTTP response does not contain HTTP/1.1 200 OK. 
     */
    private function request($pURL) {
    	$aCurlResource = curl_init();
    	curl_setopt($aCurlResource, CURLOPT_URL, $pURL);
    	curl_setopt($aCurlResource, CURLOPT_HEADER, 1);
    	curl_setopt($aCurlResource, CURLOPT_RETURNTRANSFER, 1);
        $aContent = curl_exec($aCurlResource);
        curl_close($aCurlResource);
        if (preg_match("/^HTTP\/1.1\s200\sOK\s.*/", $aContent) == false) {
    		throw new Exception($aContent);
		} 
		return $aContent;         	
    }
}
?>
