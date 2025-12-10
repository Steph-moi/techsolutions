<?php
require_once 'config/database.php';

// Suppression des anciennes configurations
$pdo->exec("DELETE FROM ordinateurs");

// Configurations selon la documentation technique
$configurations = [
    [
        'nom' => 'Configuration Type A - DÉVELOPPEMENT',
        'prix' => 2899.95,
        'processeur' => 'AMD Ryzen 7 7700X (8 cœurs/16 threads, 4.5-5.4 GHz)',
        'ram' => 'Corsair Vengeance DDR5 32 Go (2x16 Go) 5600 MHz',
        'stockage' => 'Samsung 990 Pro 1 To NVMe PCIe 4.0 (7000/5000 Mo/s)',
        'carte_graphique' => 'GPU intégré AMD Radeon RDNA 2',
        'description' => 'Poste haute performance pour développement logiciel. Boîtier Fractal Design North, carte mère ASUS TUF B650-PLUS WIFI, alimentation Corsair RM750e 80+ Gold. Double écran ASUS 27" QHD. Idéal compilation, VM légères, développement multi-thread.',
        'disponible' => 1
    ],
    [
        'nom' => 'Configuration Type A - INFRASTRUCTURES',
        'prix' => 3299.95,
        'processeur' => 'AMD Ryzen 7 7700X (8 cœurs/16 threads, 4.5-5.4 GHz)',
        'ram' => 'Corsair Vengeance DDR5 64 Go (2x32 Go) 5600 MHz',
        'stockage' => 'Samsung 990 Pro 1 To + Samsung 870 EVO 1 To',
        'carte_graphique' => 'ASRock Radeon RX 6400 Challenger ITX 4GB',
        'description' => 'Configuration renforcée pour administration système. 64 Go RAM pour 10+ VM simultanées, double stockage SSD, GPU dédié pour multi-écrans. Virtualisation, serveurs, infrastructure réseau.',
        'disponible' => 1
    ],
    [
        'nom' => 'Configuration Type B - DESIGN UX/UI',
        'prix' => 3599.95,
        'processeur' => 'AMD Ryzen 7 7700X (8 cœurs/16 threads, 4.5-5.4 GHz)',
        'ram' => 'Corsair Vengeance DDR5 32 Go (2x16 Go) 5600 MHz',
        'stockage' => 'Samsung 990 Pro 1 To NVMe PCIe 4.0',
        'carte_graphique' => 'ASUS Dual GeForce RTX 5060 OC 8GB GDDR6',
        'description' => 'Poste créatif professionnel. RTX 5060 8GB pour Adobe Suite, écran BenQ 27" calibré (99% Adobe RGB), tablette Wacom Intuos Pro. CUDA, Ray Tracing, NVENC vidéo. Design graphique, UX/UI, vidéo.',
        'disponible' => 1
    ],
    [
        'nom' => 'Configuration Type C - BUREAUTIQUE',
        'prix' => 1299.95,
        'processeur' => 'AMD Ryzen 5 7600 (6 cœurs/12 threads, 3.8-5.1 GHz)',
        'ram' => 'Kingston FURY Beast DDR5 16 Go (2x8 Go) 5600 MHz',
        'stockage' => 'Kingston SSD NV3 500 Go PCIe 4.0 NVMe',
        'carte_graphique' => 'GPU intégré AMD Radeon RDNA 2',
        'description' => 'Poste bureautique moderne. Boîtier compact Micro-ATX, carte mère MSI B650M GAMING PLUS WIFI. Double écran 24" Full HD. Office, Teams, CRM, navigation web. Silencieux et économe.',
        'disponible' => 1
    ],
    [
        'nom' => 'Configuration Type C - POSTE ADAPTÉ HANDICAP VISUEL',
        'prix' => 1599.95,
        'processeur' => 'AMD Ryzen 5 7600 (6 cœurs/12 threads, 3.8-5.1 GHz)',
        'ram' => 'Kingston FURY Beast DDR5 16 Go (2x8 Go) 5600 MHz',
        'stockage' => 'Kingston SSD NV3 500 Go PCIe 4.0 NVMe',
        'carte_graphique' => 'GPU intégré AMD Radeon RDNA 2',
        'description' => 'Configuration bureautique adaptée malvoyants. Clavier gros caractères contrastés, logiciel NVDA, Windows 11 contraste élevé, loupe 200%. Accessibilité maximale, conformité normes françaises.',
        'disponible' => 1
    ],
    [
        'nom' => 'Configuration Type D - DIRECTION POSTES FIXES',
        'prix' => 1899.95,
        'processeur' => 'AMD Ryzen 5 7600 (6 cœurs/12 threads, 3.8-5.1 GHz)',
        'ram' => 'Kingston Fury Beast DDR5 16 Go (2x8 Go) 5600 MHz',
        'stockage' => 'Kingston SSD NV3 500 Go + Samsung T7 1 To externe chiffré',
        'carte_graphique' => 'GPU intégré AMD Radeon RDNA 2',
        'description' => 'Poste direction sécurisé. SSD externe Samsung T7 chiffré AES-256, lecteur biométrique Kensington VeriMark, casque Logitech H390. Sécurité renforcée, documents confidentiels.',
        'disponible' => 1
    ],
    [
        'nom' => 'Configuration Type E - DIRECTION PORTABLE',
        'prix' => 1949.95,
        'processeur' => 'Intel Core i7-1360P (12 cœurs 4P+8E, jusqu\'à 5.0 GHz)',
        'ram' => '32 Go DDR5 5200 MHz (soudée)',
        'stockage' => '1 To SSD NVMe PCIe 4.0',
        'carte_graphique' => 'NVIDIA T550 4 Go GDDR6 + Intel Iris Xe',
        'description' => 'Lenovo ThinkPad P16s Gen 2. Écran 16" WQXGA (2560x1600), WiFi 6E, lecteur empreintes, TPM 2.0, 86 Wh batterie (10-12h). Nomadisme direction, présentations, sécurité maximale.',
        'disponible' => 1
    ]
];

// Insertion des nouvelles configurations
$stmt = $pdo->prepare("INSERT INTO ordinateurs (nom, prix, processeur, ram, stockage, carte_graphique, description, disponible) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($configurations as $config) {
    $stmt->execute([
        $config['nom'],
        $config['prix'],
        $config['processeur'],
        $config['ram'],
        $config['stockage'],
        $config['carte_graphique'],
        $config['description'],
        $config['disponible']
    ]);
}

echo "Configurations mises à jour avec succès selon la documentation technique TechSolutions !";
?>