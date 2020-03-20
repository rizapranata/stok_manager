<?php
class Barang {
    private $_db = null;
    private $_formItem = [];

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function validasi($formMethod){
        $validate = new Validate($formMethod);

        $this->_formItem['nama_barang'] = $validate->setRules('nama_barang',
            'Nama Barang', [
                'required' => true,
                'sanitize' => 'string'
        ]);

        $this->_formItem['jumlah_barang'] = $validate->setRules('jumlah_barang',
            'Jumlah Barang',[
                'numeric' => true,
                'min_value' => 0
            ]
        );

        $this->_formItem['harga_barang'] = $validate->setRules('harga_barang',
            'Harga Barang',[
                'numeric' => true,
                'min_value' => 0
        ]);

        if (!$validate->passed()) {
            return $validate->getError();
        }
    }

    public function getItem($item){
        return isset($this->_formItem[$item]) ? $this->_formItem[$item] : '';
    }

    public function insert(){
        $newBarang = [
            'nama_barang' => $this->getItem('nama_barang'),
            'jumlah_barang' => $this->getItem('jumlah_barang'),
            'harga_barang' => $this->getItem('harga_barang')
        ];
        return $this->_db->insert('barang',$newBarang);
    }

    public function generate($id_barang){
        $result = $this->_db->getWhereOnce('barang',['id_barang','=',$id_barang]);
        foreach ($result as $key => $value) {
            $this->_formItem[$key] = $value;
        }
    }

    public function update($id_barang){
        $newBarang = [
            'nama_barang' => $this->getItem('nama_barang'),
            'jumlah_barang' => $this->getItem('jumlah_barang'),
            'harga_barang' => $this->getItem('harga_barang')
        ];
        $this->_db->update('barang',$newBarang,['id_barang','=',$id_barang]);
    }

    public function delete($id_barang){
        $this->_db->delete('barang',['id_barang','=',$id_barang]);
    }

}