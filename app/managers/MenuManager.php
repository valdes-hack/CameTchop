<?php
class MenuManager extends Model {

    // Récupérer le menu actif pour aujourd'hui
    public function getTodayMenu() {
        $stmt = $this->db->prepare("SELECT * FROM menus_journaliers WHERE date = CURDATE() AND est_ouvert = 1 LIMIT 1");
        $stmt->execute();
        return $stmt->fetch();
    }

    // Publier un nouveau menu (Scénario Page 19)
    public function publishMenu($data) {
        $stmt = $this->db->prepare("INSERT INTO menus_journaliers (date, heure_limite, est_ouvert) VALUES (:date, :heure, 1)");
        return $stmt->execute([
            'date' => $data['date'],
            'heure' => $data['heure_limite'] ?? '16:00:00'
        ]);
    }

    // Fermer les commandes automatiquement (Page 19 - 00h00 Fermeture)
    public function closeOrders() {
        $stmt = $this->db->prepare("UPDATE menus_journaliers SET est_ouvert = 0 WHERE date = CURDATE()");
        return $stmt->execute();
    }
}