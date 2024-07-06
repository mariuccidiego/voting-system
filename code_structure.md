voting-system/
├── backend/
│   ├── config/
│   │   └── database.php
│   ├── api/
│   │   ├── candidato.php
│   │   ├── lista.php
│   │   ├── proposta.php
│   │   ├── risultato.php
│   │   ├── sezione.php
│   │   ├── votante.php
│   │   ├── votazione.php
│   │   └── voto.php
│   ├── models/
│   │   ├── Candidato.php
│   │   ├── Lista.php
│   │   ├── Proposta.php
│   │   ├── Risultato.php
│   │   ├── Sezione.php
│   │   ├── Votante.php
│   │   ├── Votazione.php
│   │   └── Voto.php
│   └──uploads/
│       ├── admin_img/
│       └── voting_img/
│           ├── candidates_img/
│           ├── lists_img/
│           └── other_img/
├── frontend/
│   ├── css/
│   │   └── styles.css
│   ├── js/
│   │   ├── candidato.js
│   │   ├── lista.js
│   │   ├── proposta.js
│   │   ├── risultato.js
│   │   ├── sezione.js
│   │   ├── votante.js
│   │   └── voto.js
│   ├── views/
│   │   ├── auth/
│   │   │   └── login_vote.php
│   │   ├── admin/
│   │   │   ├── login.php
│   │   │   ├── register.php
│   │   │   ├── reset_password.php
│   │   │   ├── dashboard.php
│   │   │   ├── create_votazioni.php
│   │   │   ├── manage_votazioni.php
│   │   │   ├── manage_risultati.php
│   │   │   ├── manage_lista_votanti.php
│   │   │   └── impostazioni.php
│   │   ├── layout/
│   │   │   ├── header_admin.php
│   │   │   ├── header_votazione.php
│   │   │   └── footer.php
│   │   └── votations/
│   │       ├── lista_votazioni.php
│   │       └── votazione.php
│   └── resources/
├── index.php
├── .htaccess
├── .env
└── README.md