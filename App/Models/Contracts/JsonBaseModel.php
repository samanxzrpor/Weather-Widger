<?php
namespace App\Models\Contracts;

use App\Models\Contracts\BaseModelAbstract;

class JsonBaseModel extends BaseModelAbstract
{

    public function create(array $data): int
    {
        return 1;
    }

    public function find(array $where): object
    {
        
        return (object)[];
    }

    public function get(array $where , array|string $data): object
    {
        
        $file = json_decode(file_get_contents(BASEPATH . 'current.city.list.json'));
        $input = preg_quote(ucfirst($where['city']) , '~');

        $result = array_values(preg_grep('~' . $input . '~', array_column((array)$file , 'name')));

        return (object)$result;
    }

    public function update(array $where , array $data): int
    {
        return 1;
    }

    public function delete(array $where): int
    {
        return 1;
    }


}