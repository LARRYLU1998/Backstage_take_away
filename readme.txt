php錯誤 最強烈錯誤
  parse error 全部(語法錯誤)
  fatal error 從執行錯誤之後停止

  warning 還是會執行

  notice
-------------------------------
程式的錯誤
  1.語法錯誤
  2.執行時期的錯誤
  3.邏輯的錯誤
-------------------------------
url 連結的格式
  1.完整
  http://127.0.0.1/mfee50-php/address-book/list.php?page=10#abc
  2.省略協定
  //127.0.0.1/mfee50-php/address-book/list.php?page=10#abc
  3.省略主機
  /mfee50-php/address-book/list.php?page=10#abc
  4.省略路徑
  list.php?page=10#abc
  5.省略資源檔
  ?page=10#abc
  6.只剩頁面內的連結
  #abc
  -----------------------------
  1.公開的編碼(可逆 不需要key)
    base64 
  2.hash雜湊(不可逆 不需要key)
    md5, sha1, sha256, bcrypt
  3.加解密(可逆 需要key)
    blowfish,ssl

