<link rel="stylesheet" href="../../css/header.css">
@include('clients.header')
<body>
    <h1>Welcome to {{!empty(session('profile')[0]['email']) ? session('profile')[0]['email'] : ""}} </h1>
    <h2>{{ session('profile')[0]['id'] }}</h2>
</body>
</html>