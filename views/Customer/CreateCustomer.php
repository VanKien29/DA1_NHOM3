<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Khách Hàng</h4>
        <form method="POST">
            <?php if (!empty($err['empty'])): ?>
                <div class="text-danger"><?= $err['empty'] ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="text-danger"><?= $success ?></div>
            <?php endif; ?>
            <div class="form-group mb-3">
                <label>Họ và tên</label>
                <input type="text" name="full_name" class="form-control form-control-lg" placeholder="Nhập họ và tên"
                    value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>">
                <?php if (!empty($err['full_name'])): ?>
                    <div class="text-danger err"><?= $err['full_name'] ?></div>
                <?php endif; ?>
            </div>


            <div class="form-group mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control form-control-lg" placeholder="example@email.com"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <?php if (!empty($err['email'])): ?>
                    <div class="text-danger err"><?= $err['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group mb-3">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control form-control-lg" placeholder="Nhập số điện thoại"
                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                <?php if (!empty($err['phone'])): ?>
                    <div class="text-danger err"><?= $err['phone'] ?></div>
                <?php endif; ?>
            </div>


            <div class="form-group mb-4">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control form-control-lg" placeholder="Nhập địa chỉ"
                    value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
                <?php if (!empty($err['address'])): ?>
                    <div class="text-danger err"><?= $err['address'] ?></div>
                <?php endif; ?>
            </div>
            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">Thêm khách hàng</button>
                <a href="?action=admin-listCustomer" class="btn btn-secondary btn-lg ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>