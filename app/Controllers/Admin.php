<?php

namespace App\Controllers;

use App\Controllers;
use Myth\Auth\Models\UserModel;
use App\Models\UsersModel;
use Myth\Auth\Entities\User;
use App\Models\CartModel;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\SupplierModel;
use App\Models\LayananModel;

class Admin extends BaseController
{
    protected $db, $builder, $userModel, $usersModel;
    protected $cartModel;
    protected $produkModel;
    protected $kategoriModel;
    protected $supplierModel;
    protected $layananModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->userModel = new UserModel();
        $this->usersModel = new UsersModel();
        $this->cartModel = new CartModel();
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->supplierModel = new SupplierModel();
        $this->layananModel = new LayananModel();
    }

    public function index()
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $keyword = $this->request->getVar('keyword');

        if (user_id() == 4) {
            if ($keyword) {
                $this->builder->select('users.id as UI, NIK, username, fullname, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->like('username', $keyword);
                $this->builder->orlike('fullname', $keyword);
                $this->builder->orlike('auth_groups.name', $keyword);
                // $this->builder->orderBy('auth_groups.id');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('users.id as UI, NIK, username, fullname, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->like('username', $keyword);
                $this->builder->orlike('fullname', $keyword);
                $this->builder->orlike('auth_groups.name', $keyword);
                // $this->builder->orderBy('auth_groups.id');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('users.id as UI, NIK, username, fullname, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                // $this->builder->orderBy('auth_groups.id');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('users.id as UI, NIK, username, fullname, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                // $this->builder->orderBy('auth_groups.id');
                $total = $this->builder->countAllResults();
            }
        } elseif (user_id() == 3) {
            if ($keyword) {
                $this->builder->select('users.id as UI, NIK, username, fullname, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->like('username', $keyword);
                $this->builder->orlike('fullname', $keyword);
                $this->builder->orlike('auth_groups.name', $keyword);
                // $this->builder->orderBy('auth_groups.id');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('users.id as UI, NIK, username, fullname, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->like('username', $keyword);
                $this->builder->orlike('fullname', $keyword);
                $this->builder->orlike('auth_groups.name', $keyword);
                // $this->builder->orderBy('auth_groups.id');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('users.id as UI, NIK, username, fullname, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                // $this->builder->orderBy('auth_groups.id');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('users.id as UI, NIK, username, fullname, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                // $this->builder->orderBy('auth_groups.id');
                $total = $this->builder->countAllResults();
            }
        }

        $data = [
            'title' => 'List Of Users',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'keyword' => $keyword
        ];

        $data['users'] = $query->getResult();

        return view('admin/index', $data);
    }

    public function detail($id = 0)
    {
        $data = [
            'title' => 'Details Of User',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'countTS' => 0,
            'countPD' => 0,
            'countIM' => 0,
            'countRIM' => 0,
            'countRTS' => 0,
            'countRPD' => 0,
            'countSPD' => 0,
            'countTSPD' => 0,
            'countSTS' => 0,
            'countTSTS' => 0,
            'countSIM' => 0,
            'countTSIM' => 0
        ];

        $this->builder->select('users.id as UI, users.*, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New User',
            'groupsUser' => $this->db->table('auth_groups')->getWhere()->getResultArray(),
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
        ];

        return view('admin/create', $data);
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'Edit Data User',
            'groupsUser' => $this->db->table('auth_groups')->getWhere()->getResultArray(),
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
        ];
        if ($id != null) {
            $query = $this->db->table('users')->getWhere(['id' => $id]);

            if ($query->resultID->num_rows > 0) {

                $data['user'] = $query->getRow();

                return view('admin/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id)
    {
        // dd($id);
        $this->usersModel->save([
            'id' => $id,
            'NIK' => $this->request->getVar('NIK'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'noHP' => $this->request->getVar('noHP'),
            'alamat' => $this->request->getVar('alamat'),
            'distribusi' => 1
        ]);

        // $this->db->table('auth_groups_users')->where('user_id', $id)->update([
        //     'user_id' => $id,
        //     'group_id' => $this->request->getVar('groups')
        // ]);
        return redirect()->to(site_url('/admin'))->with('pesan', 'Data Has Been Changed');
    }

    public function delete($id)
    {
        $this->db->table('users')->where(['id' => $id])->delete();
        session()->setFlashdata('pesan', 'Data Has Been Destroyed');
        return redirect()->to('/admin');
    }

    public function changePassword($id)
    {

        $data = [
            'title' => 'Change User Password',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'password' => $this->usersModel->getUsers($id)
        ];
        return view('admin/ubahPassword', $data);
    }

    public function updatePassword($id)
    {

        //Rules for the update password form
        $rules = [
            'old-password' => [
                // 'rules'  => 'required|checkOldPasswords',
                'rules'  => 'required',
                'errors' => [
                    // 'checkOldPasswords' => 'Password Lama Tidak Sesuai',
                    'required' => 'Password Lama Harus Diisi',
                ]
            ],
            'new-password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password Baru Harus Diisi',

                ]
            ],
            'password' => [
                'rules'  => 'required|matches[new-password]',
                'errors' => [
                    'required' => 'Konfirmasi Password Baru Harus Diisi',
                    'matches' => 'Password Tidak Sesuai Dengan Password Baru'
                ]
            ],
        ];

        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {

            //Create new instance of the MythAuth UserModel
            $users = model(UserModel::class);

            //Get the id of the current user
            $user_id = $id;

            //Create new user entity
            $entity = new User();

            //Get current password from input field
            $newPassword = $this->request->getVar('password');

            //Hash password using the "setPassword" function of the User entity
            $entity->setPassword($newPassword);

            //Save the hashed password in the variable "hash"
            $hash  = $entity->password_hash;

            //update the current users password_hash in the database with the new hashed password.
            $users->update($user_id, ['password_hash' => $hash]);

            //Return back with success message
            if (in_groups('admin')) {
                return redirect()->to('/admin/' . $id)->with('pesan', "Password Has Been Updated");
            } else {
                return redirect()->to('/change-password')->with('pesan', "Password Has Been Updated");
            }
        } else {
            $validation = $this->validator->getErrors();
            //Return with errors
            if (in_groups('admin')) {
                return redirect()->to('/admin/change-password/' . $id)->withInput()->with('errors', $validation);
            } else {
                return redirect()->to('/change-password')->withInput()->with('errors', $validation);
            }
        }
    }

    public function edit_my_admin()
    {

        $data['title'] = 'Edit My Profile';

        return view('/admin/edit_my_admin', $data);
    }

    public function edit_my_profile()
    {

        $data['title'] = 'Edit My Profile';

        return view('/edit_my_profile', $data);
    }

    public function listProducts()
    {

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {

            $data = [
                'title' => 'List Of Products',
                'keyword' => $keyword,
                'produk' => $this->db->table('produk')->select('produk.*, kategori.nama_kategori')->join('kategori', 'kategori.id = produk.id_kategori')->like(['nama' => $keyword])->getWhere()->getResultArray(),
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
            ];
        } else {

            $data = [
                'title' => 'List Of Products',
                'keyword' => $keyword,
                'produk' => $this->db->table('produk')->select('produk.*, kategori.nama_kategori')->join('kategori', 'kategori.id = produk.id_kategori')->getWhere()->getResultArray(),
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
            ];
        }

        return view('admin/Products/ListProduct', $data);
    }

    public function createProducts($id = 0)
    {
        $data = [
            'title' => 'Create Data Product',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'kategori' => $this->kategoriModel->getKategori(),
            'supplier' => $this->supplierModel->getSupplier(),
            'picLokasi' => $this->usersModel->getUsers()
        ];

        return view('admin/Products/createProduct', $data);
    }

    public function saveProducts($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'harap upload foto minimal 1.',
                    'is_image' => 'yang anda pilih bukan gambar.',
                    'mime_in' => 'yang anda pilih bukan gambar.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/admin/create/products/')->withInput()->with('validation', $validation);
        }

        $fileGambar = $this->request->getFile('gambar');
        $fileGambar->move('img');

        $namaGambar = $fileGambar->getName();

        // dd($id);
        $this->produkModel->save([
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'id_kategori' => $this->request->getVar('kategori'),
            'id_supplier' => $this->request->getVar('supplier'),
            'gambar' => $namaGambar
        ]);
        return redirect()->to('/admin/products')->with('pesan', 'Data Produk Berhasil Tersimpan');
    }

    public function editProducts($id)
    {
        $data = [
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'kategori' => $this->kategoriModel->getKategori(),
            'supplier' => $this->supplierModel->getSupplier(),
            'title' => 'Edit Data Product'
        ];
        if ($id != null) {
            $query = $this->db->table('produk')->select('produk.*, kategori.nama_kategori')->join('kategori', 'kategori.id = produk.id_kategori')->getWhere(['produk.id' => $id]);

            if ($query->resultID->num_rows > 0) {

                $data['produk'] = $query->getRow();

                return view('admin/Products/editProduct', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/Products/editProduct', $data);
    }

    public function updateProducts($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'gambar' => [
                'rules' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'yang anda pilih bukan gambar.',
                    'mime_in' => 'yang anda pilih bukan gambar.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/admin/products/' . $id)->withInput()->with('validation', $validation);
        }

        $fileGambar = $this->request->getFile('gambar');

        // cek apakah gambar baru apa lama
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            $fileGambar->move('img');

            $namaGambar = $fileGambar->getName();

            unlink('img/' . $this->request->getVar('gambarLama'));
        }

        // dd($id);
        $this->produkModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'id_kategori' => $this->request->getVar('kategori'),
            'id_supplier' => $this->request->getVar('supplier'),
            'gambar' => $namaGambar
        ]);
        return redirect()->to('/admin/products')->with('pesan', 'Data Produk Berhasil Terubah');
    }

    public function deleteProducts($id)
    {
        // cari gambar berdasarkan id
        $produk = $this->produkModel->find($id);

        // hapus gambar
        unlink('img/' . $produk['gambar']);

        $this->produkModel->delete($id);
        return redirect()->to('/admin/products')->with('pesan', 'Data Produk Berhasil Terhapus');
    }

    public function listCategories()
    {

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {

            $data = [
                'title' => 'List Of Categories',
                'keyword' => $keyword,
                'kategori' => $this->db->table('kategori')->like(['nama_kategori' => $keyword])->getWhere()->getResultArray(),
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
            ];
        } else {

            $data = [
                'title' => 'List Of Categories',
                'keyword' => $keyword,
                'kategori' => $this->db->table('kategori')->getWhere()->getResultArray(),
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
            ];
        }

        return view('admin/Categories/ListCategories', $data);
    }

    public function createCategories($id = 0)
    {
        $data = [
            'title' => 'Create Data Categories',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart()
        ];

        return view('admin/Categories/createCategories', $data);
    }

    public function saveCategories($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/admin/create/categories/')->withInput()->with('validation', $validation);
        }

        // dd($id);
        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getVar('nama')
        ]);
        return redirect()->to('/admin/categories')->with('pesan', 'Data Kategori Berhasil Tersimpan');
    }

    public function editCategories($id)
    {
        $data = [
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'title' => 'Edit Data Categories'
        ];
        if ($id != null) {
            $query = $this->db->table('kategori')->getWhere(['kategori.id' => $id]);

            if ($query->resultID->num_rows > 0) {

                $data['kategori'] = $query->getRow();

                return view('admin/Categories/editCategories', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/Categories/editCategories', $data);
    }

    public function updateCategories($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/admin/edit/categories/')->withInput()->with('validation', $validation);
        }

        // dd($id);
        $this->kategoriModel->save([
            'id' => $id,
            'nama_kategori' => $this->request->getVar('nama')
        ]);

        return redirect()->to('/admin/categories')->with('pesan', 'Data Kategori Berhasil Terubah');
    }

    public function deleteCategories($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/admin/categories')->with('pesan', 'Data Kategori Berhasil Terhapus');
    }

    public function listSuppliers()
    {

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {

            $data = [
                'title' => 'List Of Suppliers',
                'keyword' => $keyword,
                'supplier' => $this->db->table('supplier')->like(['nama_supplier' => $keyword])->getWhere()->getResultArray(),
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
            ];
        } else {

            $data = [
                'title' => 'List Of Suppliers',
                'keyword' => $keyword,
                'supplier' => $this->db->table('supplier')->getWhere()->getResultArray(),
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
            ];
        }

        return view('admin/Suppliers/ListSuppliers', $data);
    }

    public function createSuppliers($id = 0)
    {
        $data = [
            'title' => 'Create Data Suppliers',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart()
        ];

        return view('admin/Suppliers/createSuppliers', $data);
    }

    public function saveSuppliers($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/admin/create/suppliers/')->withInput()->with('validation', $validation);
        }

        // dd($id);
        $this->supplierModel->save([
            'nama_supplier' => $this->request->getVar('nama')
        ]);
        return redirect()->to('/admin/suppliers')->with('pesan', 'Data Supplier Berhasil Tersimpan');
    }

    public function editSuppliers($id)
    {
        $data = [
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'title' => 'Edit Data Suppliers'
        ];
        if ($id != null) {
            $query = $this->db->table('supplier')->getWhere(['supplier.id' => $id]);

            if ($query->resultID->num_rows > 0) {

                $data['supplier'] = $query->getRow();

                return view('admin/Suppliers/editSuppliers', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/Suppliers/editSuppliers', $data);
    }

    public function updateSuppliers($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/admin/edit/suppliers/')->withInput()->with('validation', $validation);
        }

        // dd($id);
        $this->supplierModel->save([
            'id' => $id,
            'nama_supplier' => $this->request->getVar('nama')
        ]);

        return redirect()->to('/admin/suppliers')->with('pesan', 'Data Supplier Berhasil Terubah');
    }

    public function deleteSuppliers($id)
    {
        $this->supplierModel->delete($id);
        return redirect()->to('/admin/suppliers')->with('pesan', 'Data Supplier Berhasil Terhapus');
    }

    public function listServices()
    {

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {

            $data = [
                'title' => 'List Of Services',
                'keyword' => $keyword,
                'layanan' => $this->db->table('layanan')->like(['nama_layanan' => $keyword])->getWhere()->getResultArray(),
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
            ];
        } else {

            $data = [
                'title' => 'List Of Services',
                'keyword' => $keyword,
                'layanan' => $this->db->table('layanan')->getWhere()->getResultArray(),
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
            ];
        }

        return view('admin/Layanan/listLayanan', $data);
    }

    public function createServices($id = 0)
    {
        $data = [
            'title' => 'Create Data Services',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart()
        ];

        return view('admin/layanan/createLayanan', $data);
    }

    public function saveServices($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/admin/create/services/')->withInput()->with('validation', $validation);
        }

        // dd($id);
        $this->layananModel->save([
            'nama_layanan' => $this->request->getVar('nama')
        ]);
        return redirect()->to('/admin/services')->with('pesan', 'Data Layanan Berhasil Tersimpan');
    }

    public function editServices($id)
    {
        $data = [
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'title' => 'Edit Data Services'
        ];
        if ($id != null) {
            $query = $this->db->table('layanan')->getWhere(['layanan.id' => $id]);

            if ($query->resultID->num_rows > 0) {

                $data['layanan'] = $query->getRow();

                return view('admin/layanan/editlayanan', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/layanan/editLayanan', $data);
    }

    public function updateServices($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/admin/edit/services/')->withInput()->with('validation', $validation);
        }

        // dd($id);
        $this->layananModel->save([
            'id' => $id,
            'nama_layanan' => $this->request->getVar('nama')
        ]);

        return redirect()->to('/admin/services')->with('pesan', 'Data Layanan Berhasil Terubah');
    }

    public function deleteServices($id)
    {
        $this->layananModel->delete($id);
        return redirect()->to('/admin/services')->with('pesan', 'Data Layanan Berhasil Terhapus');
    }
}
