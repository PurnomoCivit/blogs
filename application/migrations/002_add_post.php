<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_post extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'post_title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '150',
                        ),
                        'post_slug' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'post_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'thumbnail' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '150',
                                'null' => TRUE,
                        ),
                        'created_at' => array(
                                'type' => 'datetime',
                        ),
                        'updated_at' => array(
                                'type' => 'datetime',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('post');
        }

        public function down()
        {
                $this->dbforge->drop_table('post');
        }
}