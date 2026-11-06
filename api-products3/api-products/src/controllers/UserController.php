<?php
class UserController {
    public function __construct(private PDO $db) {}


    public function index(): void {
        $stmt = $this->db->query("SELECT id, name, email, created_at FROM users");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    
    public function show(int $id): void {
        $stmt = $this->db->prepare("SELECT id, name, email, created_at FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
            return;
        }
        echo json_encode($user);
    }

    
    public function store(): void {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios']);
            return;
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        try {
            $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$data['name'], $data['email'], $hashedPassword]);

            http_response_code(201);
            echo json_encode(['mensaje' => 'Usuario creado exitosamente', 'id' => (int) $this->db->lastInsertId()]);
        } catch (PDOException $e) {
            http_response_code(400);
            echo json_encode(['error' => 'El correo electrónico ya está registrado']);
        }
    }

    
    public function update(int $id): void {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['name']) || empty($data['email'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios']);
            return;
        }

        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['email'], $id]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado o sin cambios']);
            return;
        }

        http_response_code(200);
        echo json_encode(['mensaje' => 'Usuario actualizado exitosamente']);
    }

    
    public function destroy(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
            return;
        }

        http_response_code(200);
        echo json_encode(['mensaje' => 'Usuario eliminado exitosamente']);
    }
}