<?php
/**
 *
 *
 * @package     PHPCAS
 *
 * @author      Daniel Cousineau <danielc@doit.tamu.edu>
 * 
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright   © 2010 Department of IT, Division of Student Affairs, Texas A&M University
 */
class CAS_Client
{
    /**
     * Indicates the client requires the user to be redirected to the login
     * service as there is not ticket id present.
     */
    const REDIRECTED_FOR_LOGIN = 'REDIRECTED_FOR_LOGIN';
    
    /**
     * 
     * @var boolean
     */
    protected $_serverSSL = false;
    
    /**
     * 
     * @var string
     */
    protected $_serverHostname = null;
    
    /**
     * 
     * @var int
     */
    protected $_serverPort = null;
    
    /**
     * 
     * @var string
     */
    protected $_serverURI = null;
    
    /**
     * 
     * @var CAS_Version
     */
    protected $_version;
    
    /**
     * 
     * @var CAS_Ticket|null
     */
    protected $_ticket = null;

    /**
     * 
     * @var array
     */
    protected $_curlOptions = array(
        CURLOPT_SSL_VERIFYHOST => false,    // verify server's certificate corresponds to its name
        CURLOPT_SSL_VERIFYPEER => false,    // don't verify the whole certificate though
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "curl",   // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    /**
     * 
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if( !function_exists('curl_init') )
        {
            throw new CAS_Exception("PHP's CURL extension is required for CAS authentication");
        }

        if( !function_exists('simplexml_load_string') )
        {
            throw new CAS_Exception("PHP's SIMPLEXML extension is required for CAS authentication");
        }
        
        $this->setOptions($options);
    }
    
    /**
     *
     * @param array $options
     * @return CAS_Client *fluent interface*
     */
    public function setOptions(array $options)
    {
        foreach( $options as $key => $value )
        {
            $method = "set$key";
            
            if( $method == strtolower(__FUNCTION__) )
                throw new CAS_Exception("Invalid Option '$key'");
            
            $reflection = new ReflectionObject($this);
            
            if( $reflection->hasMethod($method) )
            {
                if( !is_array($value) )
                    $value = array($value);
                
                $reflection->getMethod($method)->invokeArgs($this, $value);
            }
            else
            {
                throw new CAS_Exception("'$key' option does not exist");
            }
        }
        
        return $this;
    }
    
    /**
     * Triggers a login.
     * 
     * If a ticket is present in the _GET string, it validates and returns the
     * ticket.
     * 
     * If not ticket is present it redirects to the login service (only if
     * $autoRedirect is set to true) and returns a CAS_Client::REDIRECTED_FOR_LOGIN 
     * status code.
     * 
     * @param boolean $autoRedirect
     * @return CAS_Ticket|int
     */
    public function login(CAS_Ticket $ticket = null, $autoRedirect = true)
    {
        if( $ticket )
        {
            $this->setTicket($ticket);
            return $this->getVersion()->validateTicket($ticket);
        }
        else if( ($ticket = $this->getTicket()) instanceOf CAS_Ticket )
        {
            return $this->getVersion()->validateTicket($ticket);
        }
        else
        {
            if( $autoRedirect )
                header('Location: ' . $this->getCASLoginService());
    
            return self::REDIRECTED_FOR_LOGIN;
        }
    }
    
    /**
     * Shortcut to get CAS Login Service URL from the CAS version
     * 
     * @return string
     */
    public function getCASLoginService()
    {
        return $this->getVersion()->getCASLoginService();
    }
    
    /**
     * Wrapper function to make a CURL request
     * 
     * @param string $url
     * @return string
     */
    public function curl_fetch($url)
    {
        $ch = curl_init($url);
        
        curl_setopt_array($ch, $this->getCurlOptions());

        $output = curl_exec($ch);

        if( $output === false )
        {
            throw new CAS_Exception("CURL Error: #" . curl_errno($ch) . " " . curl_error($ch));
        }

        curl_close($ch);

        return $output;
    }
    
    /**
     * 
     * @param CAS_Ticket $ticket
     * @return CAS_Client *fluent interface*
     */
    public function setTicket(CAS_Ticket $ticket = null)
    {
        $this->_ticket = $ticket;
        return $this;
    }
    
    /**
     * 
     * @return CAS_Ticket
     */
    public function getTicket()
    {
        return $this->_ticket;
    }
    
    /**
     * Force the use of SSL when connecting to the CAS server
     *
     * @param boolean $ssl
     * @return CAS_Client *Provides a fluid interface*
     */
    public function setServerSSL($ssl)
    {
        $this->_serverSSL = (bool)$ssl;
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function getServerSSL()
    {
        return (bool)$this->_serverSSL;
    }

    /**
     * The domain portion of the URL (e.g. http://DOMAIN/path/)
     *
     * @param string $hostname
     * @return CAS_Client *Provides a fluid interface*
     */
    public function setServerHostname($hostname)
    {
        $this->_serverHostname = trim($hostname, '\\/');
        return $this;
    }

    /**
     * The domain portion of the URL (e.g. http://DOMAIN/path/)
     *
     * @return string
     */
    public function getServerHostname()
    {
        return $this->_serverHostname;
    }

    /**
     * 
     * @param int $port
     * @return CAS_Client *Provides a fluid interface*
     */
    public function setServerPort($port)
    {
        if( $port == null )
            $this->_serverPort = null;
        else if( !is_int($port) )
            throw new CAS_Exception("Port '{$port}' must be an integer");
        else
            $this->_serverPort = (int)$port;

        return $this;
    }

    /**
     *
     * @return int
     */
    public function getServerPort()
    {
        return $this->_serverPort;
    }

    /**
     * The path portion of the URL (e.g. http://domain/PATH/)
     *
     * @param string $uri
     * @return CAS_Client *Provides a fluid interface*
     */
    public function setServerURI($uri)
    {
        $this->_serverURI = '/' . trim($uri,'\\/');
        return $this;
    }

    /**
     * The path portion of the URL (e.g. http://domain/PATH/)
     *
     * @return string
     */
    public function getServerURI()
    {
        return $this->_serverURI;
    }

    /**
     * @param array $options
     * @return CAS_Client *Provides a fluid interface*
     */
    public function setCurlOptions(array $options)
    {
        foreach( $options as $key => $value )
        {
            $this->_curlOptions[$key] = $value;
        }
        
        return $this;
    }

    /**
     * @return array
     */
    public function getCurlOptions()
    {
        return $this->_curlOptions;
    }
    
    /**
     * The parameter $version can either be an instance of CAS_Version, a string,
     * or an array defintion of a version. For example:
     * 
     * If $version == '2', this method would look for and instantiate
     * CAS_Version_2.
     * 
     * If $version == array('3', array('arg1', 'arg2')), this method would look
     * for and instantiate CAS_Version_3 with the args 'arg1' and 'arg2' (e.g. 
     * new CAS_Version_3('arg1', 'arg2'); )
     * 
     * @param CAS_Version|string $version
     * @param mixed $arg1,... Arguments to pass to the version object if setVersion is handling the creation
     * @return CAS_Client *Provides a fluid interface*
     */
    public function setVersion($version)
    {
        if( $version instanceOf CAS_Version )
        {
            $this->_version = $version;
        }
        else if( !empty($version) )
        {
            $class = "CAS_Version_$version";

            $args = func_get_args();
            unset($args[0]);

            if( class_exists($class) )
            {
                $reflection = new ReflectionClass($class);

                $this->_version = $reflection->newInstanceArgs((array)$args);
            }
            else
            {
                throw new CAS_Exception("CAS version $version_no class not found (Looking for '$class')");
            }
        }
        else
        {
            throw new CAS_Exception("Invalid version provided");
        }
        
        $this->_version->setClient($this);
        
        return $this;
    }
    
    /**
     * 
     * @return CAS_Version
     */
    public function getVersion()
    {
        return $this->_version;
    }
    
    /**
     * Loads a CAS class based on the PEAR naming standards.
     * 
     * For example, passing "CAS_Version_2" causes this method to look for the
     * file "./Version/2.php" (relative to this file's location).
     * 
     * @param string $class
     */
    public static function loadClass($class)
    {
        $class = explode('_', $class);
        
        if( strtoupper($class[0]) != 'CAS')
            return;
        
        unset($class[0]);
            
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class) . '.php';
        
        if( file_exists($file) )
            require_once $file;
    }
    
    /**
     * Register's the auto-loader using the spl_autoload_register() function.
     */
    public static function registerAutoload()
    {
        spl_autoload_register(array(__CLASS__, 'loadClass'));
    }
}