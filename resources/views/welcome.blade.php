<!DOCTYPE HTML>
<html>

<head>
    <title>Test Hub Button</title>
</head>

<body>
</body>

<script>
    const options = {
  method: 'POST',
  headers: {
    'Authorization': 'Basic ' + btoa("pk_test_wM7Qe6V5fDuOekqL*:"),
    'Content-Type': 'application/json'
  }
};

// Carrega o arquivo JSON usando XMLHttpRequest
const xhr = new XMLHttpRequest();
xhr.open('GET', 'caminho/do/arquivo/body.json', true);
xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200) {
    // Converte a resposta para JSON e atualiza as opções
    options.body = xhr.responseText;

    // Faz a requisição usando a Fetch API
    fetch('https://api.pagar.me/core/v5/orders', options)
      .then(response => response.json())
      .then(data => console.log(data))
      .catch(error => console.error('Erro:', error));
  }
};
xhr.send();
</script>

</html>
