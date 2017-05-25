$(function() {
    var availableTags = [
		'Afrikaans','Albanian','Amharic','Arabic','Armenian','Aymara','Azerbaijani','Belarusian','Bengali',
'Berber','Bislama','Bosnian','Bulgarian','Burmese','Cantonese','Catalan','Chinese, Mandarin','Chichewa','Croatian','Czech',
'Danish','Dari','Dhivehi','Dutch','Dzongkha','English','Estonian','Fijian','Filipino','Finnish','French','Georgian','German',
'Greek','Guaran','Gujarati','Haitian Creole','Hausa','Hebrew','Hindi','Hiri Motu','Hungarian','Ibo','Icelandic','Indonesian',
'Irish','Italian','Japanese','Kazakh','Khmer','Kinyarwanda','Kikongo','Kirundi','Kituba','Korean','Kurdish','Kyrgyz','Lao',
'Latin','Latvian','Lingala','Lithuanian','Luxembourgish','Macedonian','Malagasy','Malay','Maltese','Manx Gaelic','Maori',
'Moldovan','Mongolian','Montenegrin','Ndebele','Nepali','New Zealand','Northern Sotho','Norwegian','Ossetian','Punjabi',
'Papiamento','Pashtu','Persian','Polish','Portuguese','Quechua','Romanian','Romansh','Russian','Sango','Serbian',
'Seychellois Creole','Shona','Sinhala','Slovak','Slovene','Somali','Sotho','Spanish','Swahili','Swati','Swedish','Tajik',
'Tagalog','Tamil','Tetum','Thai','Tigrinya','Tok Pisin','Tshiluba','Tsonga','Tswana','Turkish','Turkmen','Ukrainian','Urdu',
'Uzbek','Venda','Vietnamese','Welsh','Xhosa','Yoruba','Zulu'   
    ];
    $("#street_no").autocomplete({
      source: availableTags
    });
  });