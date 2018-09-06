<?php


use Phinx\Migration\AbstractMigration;

class Profile extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        if( $this->hasTable('profile') ) return ;
        $table = $this->table('profile',['id' => 'uid']);
        $table  ->addColumn('quote','text',['null'=>true,'encoding'=>'utf8','collation'=>'utf8_bin'])
                ->addColumn('quote_ref','text',['null'=>true,'encoding'=>'utf8','collation'=>'utf8_bin'])
                ->addColumn('avatarurl','text',['null'=>true,'encoding'=>'utf8','collation'=>'utf8_bin'])
                ->addColumn('backgroundurl','text',['null'=>true,'encoding'=>'utf8','collation'=>'utf8_bin'])
                ->create();
    }
}
