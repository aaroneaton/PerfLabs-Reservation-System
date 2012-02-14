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
class CAS_Ticket
{
    /**
     * 
     * @var string
     */
    protected $_ticketid;
    
    /**
     * 
     * @var string
     */
    protected $_netid;
    
    /**
     * 
     * @var string
     */
    protected $_uin;
    
    /**
     * 
     * @return CAS_Ticket
     */
    public static function createFromGET($key = 'ticket')
    {
        if( !isset($_GET[$key]) )
            return null;
        
        return new self($_GET[$key]);
    }
    
    /**
     *
     * @param string $ticketid
     * @param string $netid
     * @param string $uin
     * @param string $user
     */
    public function __construct($ticketid, $netid = null, $uin = null)
    {
        $this->setTicketID($ticketid)
             ->setNetID($netid)
             ->setUIN($uin);
    }
    
    /**
     *
     * @param string $ticketid
     * @return CAS_Ticket *Provides a fluid interface*
     */
    public function setTicketID($ticketid)
    {
        $this->_ticketid = (string)$ticketid;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTicketID()
    {
        return $this->_ticketid;
    }

    /**
     *
     * @param string $netid
     * @return CAS_Ticket *Provides a fluid interface*
     */
    public function setNetID($netid)
    {
        $this->_netid = (string)$netid;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getNetID()
    {
        return $this->_netid;
    }

    /**
     *
     * @param string $uin
     * @return CAS_Ticket *Provides a fluid interface*
     */
    public function setUIN($uin)
    {
        $this->_uin = (string)$uin;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUIN()
    {
        return $this->_uin;
    }
}