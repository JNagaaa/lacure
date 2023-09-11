<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $data['title'] }}</title>
    <style>
        /* Global styles */
        body {
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        /* Wrapper for the whole email content */
        .email-wrapper {
            width: 50%;
            margin: 20px auto;
            background-color: #ffffff; /* White background color */
            border-radius: 10px;
            padding: 20px;
        }

        /* Headings */
        h1, h2, h3, h4, h5, h6 {
            color: #333333;
        }

        /* Links */
        a {
            color: #007bff;
        }

        /* Paragraphs */
        p {
            color: #555555;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        
        <p style="text-align: center;">Bonjour,</p>
        <p style="text-align: center;">Une nouvelle actualité a été publiée sur notre site.</p>
        <h2 style="text-align: center; margin-bottom: 15px;">{{ $data['title'] }}</h2>
        
        <p style="text-align: center; margin-top: 20px;">Vous pouvez consulter cette news en cliquant <a href="{{ $data['news_link'] }}">ici</a>.</p>
        <p style="text-align: center; margin-bottom: 20px;">
        <p style="text-align: center;">Par ailleurs, n'hésitez pas à consultez nos autres actualités sur notre site internet.</p>
        <p style="text-align: center;">Cordialement,</p>
        <p style="text-align: right;">La Cure</p>
        <p style="text-align: right;">Drève 4</p>
        <p style="text-align: right;">1370 Zétrud-Lumay</p>
        <p style="text-align: right;">Belgique</p>
    </div>
</body>
</html>