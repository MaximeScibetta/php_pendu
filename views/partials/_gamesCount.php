<?php if (isset($data['gamesCount'])): ?>
    <div>
        Tu as déjà joué <?= $data['gamesCount']; ?> parties (et tu en as gagné <?= $data['gamesWon']; ?>)
    </div>
<?php endif; ?>
