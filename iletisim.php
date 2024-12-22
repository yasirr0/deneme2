<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost";      // Sunucu
$username = "root";             // MySQL kullanıcı adı
$password = "";                 // MySQL şifresi (XAMPP varsayılan olarak boş)
$dbname = "iletisim_bilgileri"; // Veritabanı adı

// Veritabanı bağlantısı
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Formdan gelen veriler
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcıdan gelen verileri temizle
    $isim = isset($_POST['name']) ? $conn->real_escape_string(htmlspecialchars($_POST['name'])) : ''; // İsim
    $email = isset($_POST['email']) ? $conn->real_escape_string(htmlspecialchars($_POST['email'])) : ''; // E-posta
    $mesaj = isset($_POST['message']) ? $conn->real_escape_string(htmlspecialchars($_POST['message'])) : ''; // Mesaj

    // Verilerin boş olmadığını kontrol et
    if (empty($isim) || empty($email) || empty($mesaj)) {
        echo "Lütfen tüm alanları doldurun!";
    } else {
        // SQL sorgusunu oluştur
        $sql = "INSERT INTO form_verileri (isim, email, mesaj) VALUES ('$isim', '$email', '$mesaj')";

        // Sorguyu çalıştır ve kontrol et
        if ($conn->query($sql) === TRUE) {
            echo "Veri başarıyla eklendi!";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
