<?php

namespace App\Controllers;

class TestUploadController extends BaseController
{
    public function index()
    {
        // Untuk melihat semua session flash data
        $session = session();
        $debugInfo = [
            'session_errors' => $session->getFlashdata('errors'),
            'session_error' => $session->getFlashdata('error'),
            'session_input' => $session->getFlashdata('_ci_old_input')
        ];
        
        if ($this->request->getMethod() === 'post') {
            echo "<div style='font-family: monospace; background: #f5f5f5; padding: 20px; border: 1px solid #ccc; margin: 20px;'>";
            echo "<h2>🚨 DEBUG DETAIL - UPLOAD TEST CI4 🚨</h2>";
            echo "<hr>";
            
            // 1. Cek Method dan Content Type
            echo "<h3>1. REQUEST INFO:</h3>";
            echo "Method: " . $this->request->getMethod() . "<br>";
            echo "isAJAX: " . ($this->request->isAJAX() ? 'Yes' : 'No') . "<br>";
            echo "Content-Type: " . ($_SERVER['CONTENT_TYPE'] ?? 'Not set') . "<br>";
            echo "Content-Length: " . ($_SERVER['CONTENT_LENGTH'] ?? 'Not set') . "<br>";
            
            // 2. Tampilkan POST Data
            echo "<h3>2. POST Data (\$_POST):</h3>";
            echo "<pre>";
            if (empty($_POST)) {
                echo "⚠️ \$_POST array is EMPTY!";
            } else {
                print_r($_POST);
            }
            echo "</pre>";
            
            // 3. Tampilkan FILES Data (RAW)
            echo "<h3>3. FILES Data (RAW \$_FILES):</h3>";
            echo "<pre>";
            if (empty($_FILES)) {
                echo "⚠️ \$_FILES array is EMPTY!<br>";
                echo "Check enctype='multipart/form-data' in form";
            } else {
                print_r($_FILES);
            }
            echo "</pre>";
            
            // 4. Cek dengan CI4 Request Object
            echo "<h3>4. CI4 Request Object:</h3>";
            echo "<strong>getPost():</strong><br>";
            echo "<pre>";
            $postData = $this->request->getPost();
            if (empty($postData)) {
                echo "getPost() returns empty array";
            } else {
                print_r($postData);
            }
            echo "</pre>";
            
            echo "<strong>getFiles():</strong><br>";
            echo "<pre>";
            $filesData = $this->request->getFiles();
            if (empty($filesData)) {
                echo "getFiles() returns empty array";
            } else {
                print_r($filesData);
            }
            echo "</pre>";
            
            // 5. Cek File Object secara detail
            echo "<h3>5. File Object Analysis:</h3>";
            $file = $this->request->getFile('foto_identitas');
            
            if ($file === null) {
                echo "❌ file = \$this->request->getFile('foto_identitas') returns NULL<br>";
                echo "File tidak ditemukan dalam request";
            } else {
                echo "✅ File object ditemukan<br>";
                echo "<pre>";
                echo "getName(): " . $file->getName() . "\n";
                echo "getClientName(): " . $file->getClientName() . "\n";
                echo "getTempName(): " . $file->getTempName() . "\n";
                echo "getSize(): " . $file->getSize() . " bytes\n";
                echo "getMimeType(): " . $file->getMimeType() . "\n";
                echo "getError(): " . $file->getError() . "\n";
                echo "getErrorString(): " . $file->getErrorString() . "\n";
                echo "isValid(): " . ($file->isValid() ? 'Yes ✅' : 'No ❌') . "\n";
                echo "hasMoved(): " . ($file->hasMoved() ? 'Yes' : 'No') . "\n";
                echo "</pre>";
                
                // Coba upload jika valid
                if ($file->isValid() && !$file->hasMoved()) {
                    $uploadPath = WRITEPATH . 'uploads/test/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                        echo "📁 Created directory: $uploadPath<br>";
                    }
                    
                    // Generate nama file unik
                    $newName = $file->getRandomName();
                    
                    try {
                        if ($file->move($uploadPath, $newName)) {
                            echo "✅ <strong>UPLOAD BERHASIL!</strong><br>";
                            echo "File disimpan di: " . $uploadPath . $newName . "<br>";
                            echo "<img src='" . base_url('writable/uploads/test/' . $newName) . "' style='max-width: 300px; margin: 10px; border: 1px solid #ccc;'>";
                        } else {
                            echo "❌ Gagal memindahkan file<br>";
                        }
                    } catch (\Exception $e) {
                        echo "❌ Exception: " . $e->getMessage() . "<br>";
                    }
                } else {
                    echo "❌ File tidak valid atau sudah dipindahkan<br>";
                }
            }
            
            // 6. PHP Upload Settings
            echo "<h3>6. PHP Configuration:</h3>";
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>Setting</th><th>Value</th><th>Status</th></tr>";
            
            $settings = [
                'file_uploads' => ['On', 'Off'],
                'upload_max_filesize' => ['>= 2M', '< 2M'],
                'post_max_size' => ['>= 2M', '< 2M'],
                'upload_tmp_dir' => ['Set & Writable', 'Not set/Not writable'],
                'max_file_uploads' => ['>= 1', '< 1']
            ];
            
            foreach ($settings as $key => $status) {
                $value = ini_get($key);
                $isOk = true;
                
                switch ($key) {
                    case 'file_uploads':
                        $isOk = ($value === '1' || strtolower($value) === 'on');
                        break;
                    case 'upload_max_filesize':
                        $bytes = $this->returnBytes($value);
                        $isOk = ($bytes >= 2 * 1024 * 1024);
                        break;
                    case 'post_max_size':
                        $bytes = $this->returnBytes($value);
                        $isOk = ($bytes >= 2 * 1024 * 1024);
                        break;
                    case 'upload_tmp_dir':
                        $isOk = ($value && is_writable($value));
                        break;
                    case 'max_file_uploads':
                        $isOk = (intval($value) >= 1);
                        break;
                }
                
                echo "<tr>";
                echo "<td>$key</td>";
                echo "<td>" . htmlspecialchars($value) . "</td>";
                echo "<td style='color: " . ($isOk ? 'green' : 'red') . ";'>";
                echo $isOk ? "✅ OK" : "❌ Problem";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // 7. Session Debug
            echo "<h3>7. Session Data:</h3>";
            echo "<pre>";
            print_r($debugInfo);
            echo "</pre>";
            
            echo "<hr>";
            echo "<p><a href='" . base_url('testupload') . "' style='padding: 10px; background: #4CAF50; color: white; text-decoration: none;'>⬅ Kembali ke Form</a></p>";
            echo "</div>";
            return;
        }
        
        // TAMPILKAN FORM
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>🧪 Test Upload CI4 - DEBUG</title>";
        echo "<style>";
        echo "body { font-family: Arial, sans-serif; margin: 20px; }";
        echo ".form-container { max-width: 500px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }";
        echo ".debug-info { background: #f0f0f0; padding: 10px; margin: 10px 0; border-radius: 5px; }";
        echo ".error { color: red; }";
        echo ".success { color: green; }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        
        echo "<h1>🧪 Test Upload CI4 - DEBUG MODE</h1>";
        
        // Tampilkan error jika ada
        if ($debugInfo['session_errors']) {
            echo "<div class='error'>";
            echo "<h3>Validation Errors:</h3>";
            echo "<ul>";
            foreach ($debugInfo['session_errors'] as $field => $error) {
                echo "<li><strong>$field:</strong> $error</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        
        if ($debugInfo['session_error']) {
            echo "<div class='error'><strong>Error:</strong> " . $debugInfo['session_error'] . "</div>";
        }
        
        echo "<div class='debug-info'>";
        echo "<h3>⚠️ DEBUG FORM</h3>";
        echo "<p>Form ini akan menampilkan SEMUA data yang dikirim ke server.</p>";
        echo "</div>";
        
        echo "<div class='form-container'>";
        echo "<form method='POST' enctype='multipart/form-data' action='" . base_url('testupload') . "'>";
        echo "<input type='hidden' name='MAX_FILE_SIZE' value='2097152'>"; // 2MB
        
        echo "<div style='margin-bottom: 15px;'>";
        echo "<label for='nama'><strong>Nama:</strong></label><br>";
        echo "<input type='text' id='nama' name='nama' placeholder='Masukkan nama' style='width: 100%; padding: 8px;'>";
        echo "</div>";
        
        echo "<div style='margin-bottom: 15px;'>";
        echo "<label for='foto_identitas'><strong>File Upload (wajib):</strong></label><br>";
        echo "<input type='file' id='foto_identitas' name='foto_identitas' required style='width: 100%; padding: 8px; border: 2px dashed #ccc;'>";
        echo "<small>Pilih file gambar (JPG, PNG) max 2MB</small>";
        echo "</div>";
        
        echo "<div style='margin-bottom: 15px;'>";
        echo "<label for='test_field'><strong>Field Test Lain:</strong></label><br>";
        echo "<input type='text' id='test_field' name='test_field' placeholder='Field test tambahan' style='width: 100%; padding: 8px;'>";
        echo "</div>";
        
        echo "<button type='submit' style='padding: 10px 20px; background: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;'>";
        echo "🚀 Submit untuk Debug";
        echo "</button>";
        
        echo "</form>";
        echo "</div>";
        
        echo "<hr>";
        
        echo "<div class='debug-info'>";
        echo "<h3>📋 PHP Upload Settings:</h3>";
        echo "<ul>";
        echo "<li><strong>file_uploads:</strong> " . ini_get('file_uploads') . "</li>";
        echo "<li><strong>upload_max_filesize:</strong> " . ini_get('upload_max_filesize') . "</li>";
        echo "<li><strong>post_max_size:</strong> " . ini_get('post_max_size') . "</li>";
        echo "<li><strong>upload_tmp_dir:</strong> " . (ini_get('upload_tmp_dir') ?: 'Not set') . "</li>";
        echo "</ul>";
        
        echo "<h3>🔧 Tips:</h3>";
        echo "<ol>";
        echo "<li>Pastikan form punya <code>enctype='multipart/form-data'</code></li>";
        echo "<li>File harus &lt; 2MB</li>";
        echo "<li>Cek folder <code>writable/uploads/</code> ada dan bisa diwrite</li>";
        echo "<li>Restart Apache setelah ubah php.ini</li>";
        echo "</ol>";
        echo "</div>";
        
        echo "</body>";
        echo "</html>";
    }
    
    private function returnBytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        $val = (int)$val;
        
        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        
        return $val;
    }
}