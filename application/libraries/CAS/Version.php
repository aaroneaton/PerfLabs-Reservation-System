<?php
/**
 *
 *
 * @package     PHPCAS
 * @subpackage  Version
 *
 * @author      Daniel Cousineau <danielc@doit.tamu.edu>
 * 
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright   © 2010 Department of IT, Division of Student Affairs, Texas A&M University
 */

abstract class CAS_Version
{
    /**
     * 
     * @var CAS_Client
     */
    protected $_client;
    
    /**
     * Validates a given ticket and returns the validated ticket with the user
     * credentials.
     * 
     * Throws a CAS_Exception on validation errors
     * 
     * @param CAS_Ticket $ticket
     * @return CAS_Ticket Validated Ticket
     * @throws CAS_Exception
     */
    abstract public function validateTicket(CAS_Ticket $ticket = null);

    /**
     *
     * @param array $options
     * @return CAS_Version *fluent interface*
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
     * Returns the fully qualified url for CAS
     * 
     * @return string
     */
    public function getCASURL()
    {
        return ($this->getClient()->getServerSSL() ? 'https://' : 'http://') .
               $this->getClient()->getServerHostname() .
               ($this->getClient()->getServerPort() !== null ? ':'.$this->getClient()->getServerPort() : '') .
               $this->getClient()->getServerURI();
    }
    
    /**
     * Returns the url for the login page, includes the service description
     * 
     * This is the url used to redirect the user to.
     * 
     * @return string
     */
    public function getCASLoginService()
    {
        return $this->getCASURL() . '/login?service=' . urlencode($this->getThisService());
    }
    
    /**
     * Returns the url for the validation service. ONLY RETURNS THE URL FOR THE
     * SERVICE THAT RETURNS THE FULL XML PAYLOAD.
     * 
     * This is the url used to validate the ticket ID and recieve user credentials.
     * 
     * @param CAS_Ticket $ticket
     * @return string
     */
    public function getCASValidateService(CAS_Ticket $ticket)
    {
        return $this->getCASURL() . '/serviceValidate?ticket='.urlencode($ticket->getTicketID()).'&service=' . urlencode($this->getThisService());
    }
    
    /**
     * Returns the full URL (including GET string) of the current page. Used as
     * the service descriptor for CAS (namely: the page CAS redirects the user 
     * to afer a successful login).
     * 
     * @return string
     */
    protected function getThisService()
    {
        $this_service = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://' ) .
                        $_SERVER['HTTP_HOST'];

        if( isset($_SERVER['QUERY_STRING']) && trim($_SERVER['QUERY_STRING']) != '' )
        {
            $this_service .= preg_replace('#'.preg_quote('?'.$_SERVER['QUERY_STRING'],'#').'$#i', '', $_SERVER['REQUEST_URI']);
        }
        else
        {
            $this_service .= $_SERVER['REQUEST_URI'];
        }

        $get = $_GET;
        unset($get['ticket']);

        $get = http_build_query($get);

        $this_service .= $get ? '?' . $get : '';

        return $this_service;
    }
    
    /**
     * 
     * @param CAS_Client $client
     * @return CAS_Version *fluent interface*
     */
    public function setClient(CAS_Client $client)
    {
        $this->_client = $client;
        
        return $this;
    }
    
    /**
     * 
     * @return CAS_Client
     */
    public function getClient()
    {
        return $this->_client;
    }
}