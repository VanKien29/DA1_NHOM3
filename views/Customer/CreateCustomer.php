<div class="admin-form-container">
    <div class="admin-form-card">
        <h4 class="form-title text-center mb-4">Thêm Khách Hàng</h4>

        <form method="POST">
            <div class="form-group mb-3">
                <label>Họ và tên</label>
                <input type="text" name="full_name" class="form-control form-control-lg" placeholder="Nhập họ và tên"
                    required>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="example@email.com"
                    required>
            </div>

            <div class="form-group mb-3">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control form-control-lg" placeholder="Nhập số điện thoại"
                    required>
            </div>

            <div class="form-group mb-4">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control form-control-lg" placeholder="Nhập địa chỉ"
                    required>
            </div>

            <div class="form-action text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">Thêm khách hàng</button>
                <a href="?action=admin-listCustomer" class="btn btn-secondary btn-lg ms-2 px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>