<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_tags extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 15,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'id_post' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                        ),
                        'tag_name' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'created_at' => array(
                                'type' => 'datetime',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('tags');
        }

        public function down()
        {
                $this->dbforge->drop_table('tags');
        }
}