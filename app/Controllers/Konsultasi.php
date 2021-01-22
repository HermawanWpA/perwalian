<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelKonsultasi;

class Konsultasi extends Controller
{

    public function __construct()
    {
        // helper('form');
        // $this->validation = \Config\Services::validation();
        // $this->session = session();


        $this->model = new ModelKonsultasi;
    }

    public function index()
    {

        $data =
            [
                'title' => 'View Tables',
                'tblkonsultasi' => $this->model->getALLData()
            ];
        return view('konsultasi/index', $data);
    }
    public function inputdata()
    {


        $data =
            [
                'title' => 'Input Data',
                'tblkonsultasi' => $this->model->getALLData()
            ];
        return view('konsultasi/inputdata', $data);
    }
    public function tambah()
    {

        //validasi input
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'nid' => [
                    'label' => 'Nomor Induk Mahasiswa',
                    'rules' => 'required|numeric|max_length[11]|is_unique[tblkonsultasi.nid]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'numeric' => '{field} hanya boleh angka',
                        'is_unique' => '{field} Sudah terdaftar.'
                    ]

                ],
                'mhs_nama' => [
                    'label' => 'Nama Mahasiswa',
                    'rules' => 'required|min_length[3][tblkonsultasi.mhs_nama]',
                    'errors' => [
                        'required' => '{field} minimal 3 digit.',
                    ]
                ],
                'prodi' => [
                    'label' => 'Prodi',
                    'rules' => 'required|min_length[1][tblkonsultasi.prodi]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'materi_konsultasi' => [
                    'label' => 'Alamat',
                    'rules' => 'required|min_length[5][tblkonsultasi.materi_konsultasi]',
                    'errors' => [
                        'required' => '{field} minimal 5 digit.',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal',
                    'rules' => 'required[tblkonsultasi.tanggal]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'valid_date' => '{field} Sesuai dengan data.'
                    ]
                ],

                'hasil_konsultasi' => [
                    'label' => 'Hasil Konsultasi',
                    'rules' => 'required|min_length[5][tblkonsultasi.materi_konsultasi]',
                    'errors' => [
                        'required' => '{field} minimal 5 digit.',
                    ]
                ],

            ]);
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                $data =
                    [
                        'title' => 'Input Data',
                        'tblkonsultasi' => $this->model->getALLData()
                    ];
                return view('konsultasi/inputdata', $data);
            } else {

                $data = [
                    'nid' => $this->request->getPost('nid'),
                    'mhs_nama' => $this->request->getPost('mhs_nama'),
                    'prodi' => $this->request->getPost('prodi'),
                    'materi_konsultasi' => $this->request->getPost('materi_konsultasi'),
                    'tanggal' => $this->request->getPost('tanggal'),
                    'hasil_konsultasi' => $this->request->getPost('hasil_konsultasi'),
                ];


                //insert data
                $success = $this->model->tambah($data);
                if ($success) {
                    session()->setflashdata('massage', 'Data Berhasil Ditambahkan');
                    return redirect()->to(base_url('konsultasi/inputdata'));
                }
            }
        } else {
            return redirect()->to(base_url('konsultasi/inputdata'));
        }
    }
    public function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setflashdata('massage', 'Data Berhasil Dihapus');
            return redirect()->to(base_url('konsultasi/inputdata'));
        }
    }
    public function ubah()
    {

        //validasi input ubah
        if (isset($_POST['ubah'])) {
            $nid = $this->request->getPost('nid');
            $db_nid = $this->model->getDataById($nid)['nid'];

            if ($nid === $db_nid) {
                $val = $this->validate([
                    'nid' => [
                        'label' => 'Nomor Induk Mahasiswa',
                        'rules' => 'required|numeric|max_length[11]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong.',
                            'numeric' => '{field} hanya boleh angka'

                        ]

                    ],
                    'mhs_nama' => [
                        'label' => 'Nama Mahasiswa',
                        'rules' => 'required|min_length[3][tblkonsultasi.mhs_nama]',
                        'errors' => [
                            'required' => '{field} minimal 3 digit.',
                        ]
                    ],
                    'prodi' => [
                        'label' => 'Prodi',
                        'rules' => 'required|min_length[1][tblkonsultasi.prodi]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong.',
                        ]
                    ],
                    'materi_konsultasi' => [
                        'label' => 'Alamat',
                        'rules' => 'required|min_length[5][tblkonsultasi.materi_konsultasi]',
                        'errors' => [
                            'required' => '{field} minimal 5 digit.',
                        ]
                    ],
                    'tanggal' => [
                        'label' => 'Tanggal',
                        'rules' => 'required[tblkonsultasi.tanggal]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong.',
                            'valid_date' => '{field} Sesuai dengan data.'
                        ]
                    ],

                    'hasil_konsultasi' => [
                        'label' => 'Hasil Konsultasi',
                        'rules' => 'required|min_length[5][tblkonsultasi.materi_konsultasi]',
                        'errors' => [
                            'required' => '{field} minimal 5 digit.',
                        ]
                    ],

                ]);
            } else {
                $val = $this->validate([
                    'nid' => [
                        'label' => 'Nomor Induk Nid',
                        'rules' => 'required|numeric|max_length[11]|is_unique[tblkonsultasi.nid]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong.',
                            'numeric' => '{field} hanya boleh angka',
                            'is_unique' => '{field} Sudah terdaftar.'
                        ]

                    ],
                    'mhs_nama' => [
                        'label' => 'Nama Mahasiswa',
                        'rules' => 'required|min_length[3][tblkonsultasi.mhs_nama]',
                        'errors' => [
                            'required' => '{field} minimal 3 digit.',
                        ]
                    ],
                    'prodi' => [
                        'label' => 'Prodi',
                        'rules' => 'required|min_length[1][tblkonsultasi.prodi]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong.',
                        ]
                    ],
                    'materi_konsultasi' => [
                        'label' => 'Alamat',
                        'rules' => 'required|min_length[5][tblkonsultasi.materi_konsultasi]',
                        'errors' => [
                            'required' => '{field} minimal 5 digit.',
                        ]
                    ],
                    'tanggal' => [
                        'label' => 'Tanggal',
                        'rules' => 'required[tblkonsultasi.tanggal]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong.',
                            'valid_date' => '{field} Sesuai dengan data.'
                        ]
                    ],

                    'hasil_konsultasi' => [
                        'label' => 'Hasil Konsultasi',
                        'rules' => 'required|min_length[5][tblkonsultasi.materi_konsultasi]',
                        'errors' => [
                            'required' => '{field} minimal 5 digit.',
                        ]
                    ],

                ]);
            }


            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                $data =
                    [
                        'title' => 'Input Data',
                        'tblkonsultasi' => $this->model->getALLData()
                    ];
                return view('konsultasi/inputdata', $data);
            } else {
                $id = $this->request->getPost('nid');
                $data = [
                    'nid' => $this->request->getPost('nid'),
                    'mhs_nama' => $this->request->getPost('mhs_nama'),
                    'prodi' => $this->request->getPost('prodi'),
                    'materi_konsultasi' => $this->request->getPost('materi_konsultasi'),
                    'tanggal' => $this->request->getPost('tanggal'),
                    'hasil_konsultasi' => $this->request->getPost('hasil_konsultasi'),
                ];


                //update data
                $success = $this->model->ubah($data, $id);
                if ($success) {
                    session()->setflashdata('massage', 'Data Berhasil Diubah');
                    return redirect()->to(base_url('konsultasi/inputdata'));
                }
            }
        } else {
            return redirect()->to(base_url('konsultasi/inputdata'));
        }
    }
    public function editprofile()
    { }
}
