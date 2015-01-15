<?php

class AddressModel extends \Core\Model
{
  private $result;
  // Singleton instance
  protected static $instance;

  /**
   * Singleton Factory method.
   * 
   * @return the Singleton instance of Model
   */
  public static function getInstance()
  {
    if (is_null(self::$instance)) 
      self::$instance = new self();
    return self::$instance;
  }

  function getData($id)
  {
    if (empty($this->result))
    {
      $filename = \Common\Router::getAppPath().'/data/address.csv';

      if (!is_numeric($id))
        throw new \Common\HttpException(400, "Bad Request");

      if (file_exists($filename))
      {
        $result = [];
        $f = new \SplFileObject($filename, 'rb');
        if ($id)
        {
          $f->seek($id-1);
          $f->current();
        }
        $line = $f->fgetcsv();
        if (count($line) >= 3)
        {
          $result = [
              'name' => $line[0],
              'phone' => $line[1],
              'street' => $line[2]
          ];
        }
        $this->result = $result;
        return $this->result;
      }
      else
      {
        throw new \Common\HttpException(500, 'No storage file.');
      }
    }
    return $this->result;
  }
}