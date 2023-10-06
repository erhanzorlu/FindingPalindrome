<?php

// Palindromları kontrol etmek için bir fonksiyon tanımlanır
function isPalindrome($word)
{
    // Kelimenin tüm harflerini küçük harfe dönüştür ve harf olmayan karakterleri kaldırır.
    $word = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $word)); 
    // Kelimenin uzunluğunu hesapla.
    $length = strlen($word);
    if( $length<=2){//Eğer kelime 1 veya 2 harften oluşuyorsa palindrom olamaz.
        return false;
    }

    // Kelimenin yarısına kadar döngüyü çalıştır.
    for ($i = 0; $i < $length / 2; $i++) {
        // Karşılaştırma: Dizinin başındaki ve sonundaki karakterler eşit değilse, palindrom değil.
        if ($word[$i] != $word[$length - $i - 1]) {
            return false;
        }
    }

    // Eğer döngüyü geçtiyse, kelime bir palindromdur.
    return true;
}

// HTTP POST isteği yapıldıysa ve "text" adında bir form alanı varsa bu bloğu çalıştırır.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["text"])) {
    // Kullanıcının girdiği metni alır.
    $text = $_POST["text"];
    // Metni kelimelere ayırır.
    $words = str_word_count($text, 1); 
    // Palindrom kelimeleri saklamak için bir dizi oluşturur.
    $palindromes = [];

    // Metindeki her kelime için palindrom kontrolü yapar.
    foreach ($words as $word) {
        if (isPalindrome($word)) {
            // Eğer kelime bir palindromsa, palindromları içeren diziye ekler.
            $palindromes[] = $word;
        }
    }

    // Bulunan palindromları ekrana yazdırır.
    echo "Metindeki Palindromlar: <br>";
    foreach ($palindromes as $palindrome) {
        echo $palindrome . "<br>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palindrom Bulma</title>
</head>

<body>
    <h1>Metindeki Palindromları Bulma</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="text">Metin:</label><br>
        <textarea id="text" name="text" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="Palindromları Bul">
    </form>
</body>

</html>
