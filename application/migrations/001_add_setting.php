<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_setting extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'blog_title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '150',
                        ),
                        'blog_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'blog_email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '150',
                                'null' => TRUE,
                        ),
                        'analytics' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '155',
                                'null' => TRUE,
                        ),
                        'templateId' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'created_at' => array(
                                'type' => 'datetime',
                        ),
                        'updated_at' => array(
                                'type' => 'datetime',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('setting');
        }

        public function down()
        {
                $this->dbforge->drop_table('setting');
        }
}