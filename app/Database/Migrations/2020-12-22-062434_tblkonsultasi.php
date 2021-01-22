<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblkonsultasi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'nid'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'mhs_nama'       => [
				'type'           => 'TEXT',
			],
			'prodi'       => [
				'type'           => 'TEXT',

			],
			'materi_konsultasi'       => [
				'type'           => 'TEXT',

			],
			'tanggal'       => [
				'type'           => 'DATE',
			],

			'hasil_konsultasi'       => [
				'type'           => 'TEXT',
			],


		]);
		$this->forge->addKey('nid', true);
		$this->forge->createTable('tblkonsultasi');
	}

	public function down()
	{
		$this->forge->dropTable('tblkonsultasi');
	}
}
