<?php
namespace Offer\Form;

use Zend\Form\Form;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;

class CityForm extends Form
{
    protected $adapter;
    public function __construct(AdapterInterface $dbAdapter)
    {
        $this->adapter =$dbAdapter;
                parent::__construct("Test Form");
        $this->setAttribute('method', 'post');
                //your select field
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'city',
            'options' => array(
                'value_options' => $this->getOptionsForSelect(),
                )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Dalej',
                'class' => 'button round blue image-right ic-right-arrow',
            ),
        ));

}
       public function getOptionsForSelect()
    {
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT id,name  FROM city';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['id']] = $res['name'];
        }
        return $selectData;
    }

}