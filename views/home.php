<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ND Travel - Trang chủ</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
    <!-- HEADER -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="https://bizweb.dktcdn.net/100/505/645/themes/956063/assets/logo.png?1758533840329"
                    alt="ND Travel">
            </div>
            <nav class="navbar">
                <ul>
                    <li><a href="#" class="active">Trang chủ</a></li>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Tour du lịch</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </nav>
            <a href="?action=admin" class="header-right">
                <i class="fa fa-admin"></i> <span>admin</span>
            </a>
            <div class="header-right">
                <i class="fa fa-phone"></i> <span>Hotline:</span> <b>1900 6750</b>
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="search-box">
            <div class="search-field">
                <i class="fa fa-map-marker-alt"></i>
                <input type="text" placeholder="Bạn muốn đi đâu?">
            </div>
            <div class="search-field">
                <i class="fa fa-plane-departure"></i>
                <input type="text" placeholder="Chọn điểm đi">
            </div>
            <div class="search-field">
                <i class="fa fa-plane-arrival"></i>
                <input type="text" placeholder="Chọn điểm đến">
            </div>
            <div class="search-field">
                <i class="fa fa-calendar"></i>
                <input type="text" placeholder="Chọn ngày đi">
            </div>
            <button class="btn-search">Tìm kiếm</button>
        </div>
    </section>

    <!-- BOOKING -->
    <section class="booking">
        <h2>Booking cùng ND Travel</h2>
        <p>Chỉ với 3 bước đơn giản và dễ dàng để có ngay trải nghiệm tuyệt vời!</p>
        <div class="booking-steps">
            <div class="step">
                <img src="https://cdn-icons-png.flaticon.com/512/854/854878.png" alt="">
                <h3>Tìm nơi muốn đến</h3>
                <p>Bất cứ nơi đâu bạn muốn đến, chúng tôi có tất cả những gì bạn cần.</p>
            </div>
            <div class="step">
                <img src="https://cdn-icons-png.flaticon.com/512/2991/2991108.png" alt="">
                <h3>Đặt vé</h3>
                <p>ND Travel hỗ trợ bạn đặt vé nhanh chóng và tiện lợi.</p>
            </div>
            <div class="step">
                <img src="https://cdn-icons-png.flaticon.com/512/1006/1006771.png" alt="">
                <h3>Thanh toán</h3>
                <p>Hoàn tất thanh toán và sẵn sàng cho chuyến đi của bạn!</p>
            </div>
        </div>
    </section>


    <!-- 1. KHÁM PHÁ THẾ GIỚI -->
    <section class="section experiences">
        <div class="container experiences-inner">
            <div class="experiences-text">
                <p class="section-tag">Khám phá thế giới</p>
                <h2 class="section-title-lg">Các trải nghiệm &amp; hoạt động</h2>
                <p class="section-desc">
                    ND Travel cung cấp cho bạn rất nhiều loại hình du lịch với đa dạng các trải nghiệm khác
                    nhau.
                    Đừng ngại ngần, hãy chuẩn bị và sẵn sàng ngay!
                </p>
                <a href="#" class="link-more">
                    Xem thêm
                    <span>→</span>
                </a>
            </div>

            <div class="experiences-icons">
                <!-- hàng 1 -->
                <div class="experience-item">
                    <div class="experience-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/1530/1530123.png" alt="Nghỉ dưỡng">
                    </div>
                    <span>Nghỉ dưỡng</span>
                </div>
                <div class="experience-item">
                    <div class="experience-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/744/744502.png" alt="Cáp treo">
                    </div>
                    <span>Cáp treo</span>
                </div>
                <div class="experience-item">
                    <div class="experience-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/69/69906.png" alt="Du thuyền">
                    </div>
                    <span>Du thuyền</span>
                </div>
                <div class="experience-item">
                    <div class="experience-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2190/2190552.png" alt="Mạo hiểm">
                    </div>
                    <span>Mạo hiểm</span>
                </div>

                <!-- hàng 2 -->
                <div class="experience-item">
                    <div class="experience-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/854/854878.png" alt="Khám phá">
                    </div>
                    <span>Khám phá</span>
                </div>
                <div class="experience-item">
                    <div class="experience-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/1606/1606316.png" alt="Dưới nước">
                    </div>
                    <span>Dưới nước</span>
                </div>
                <div class="experience-item">
                    <div class="experience-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/292/292108.png" alt="Ẩm thực">
                    </div>
                    <span>Ẩm thực</span>
                </div>
                <div class="experience-item">
                    <div class="experience-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2331/2331966.png" alt="Cắm trại">
                    </div>
                    <span>Cắm trại</span>
                </div>
            </div>
        </div>
    </section>


    <!-- 3. TOUR TRONG NƯỚC -->
    <section class="section tours">
        <div class="container">
            <div class="section-header-row">
                <div>
                    <h2 class="section-title-lg">Tour trong nước</h2>
                    <p class="section-desc">
                        Hơn 1.000 tour đa dạng giá hời có hạn
                    </p>
                </div>
                <div class="tabs">
                    <button class="tab active">Phú Quốc</button>
                    <button class="tab">Nha Trang</button>
                    <button class="tab">Đà Nẵng</button>
                </div>
            </div>

            <div class="tour-list">
                <!-- tour card -->
                <article class="tour-card">
                    <div class="tour-image">
                        <span class="tour-sale">-50%</span>
                        <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Phú Quốc 4 đảo">
                    </div>
                    <div class="tour-body">
                        <p class="tour-meta-top">
                            <span class="tour-meta-icon">📍</span>
                            Khởi hành từ: Phú Quốc
                        </p>
                        <h3 class="tour-title">
                            Du lịch 4 đảo Phú Quốc: Hành trình 1 ngày
                        </h3>
                        <div class="tour-rating">
                            ★★★★★
                        </div>
                        <div class="tour-price-row">
                            <span class="tour-price">1.000.000đ</span>
                            <span class="tour-old-price">2.000.000đ</span>
                        </div>
                        <p class="tour-meta-bottom">
                            ⏱ Thời gian: 1N
                        </p>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image">
                        <img src="https://images.pexels.com/photos/460376/pexels-photo-460376.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Rạch Vẹm">
                    </div>
                    <div class="tour-body">
                        <p class="tour-meta-top">
                            <span class="tour-meta-icon">📍</span>
                            Khởi hành từ: Phú Quốc
                        </p>
                        <h3 class="tour-title">
                            Tour 1 ngày: Rạch Vẹm - Bắc đảo Phú Quốc
                        </h3>
                        <div class="tour-rating">
                            ★★★★☆
                        </div>
                        <div class="tour-price-row">
                            <span class="tour-price">1.200.000đ</span>
                        </div>
                        <p class="tour-meta-bottom">
                            ⏱ Thời gian: 1N
                        </p>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image">
                        <img src="https://images.pexels.com/photos/1007657/pexels-photo-1007657.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Cano 4 đảo">
                    </div>
                    <div class="tour-body">
                        <p class="tour-meta-top">
                            <span class="tour-meta-icon">📍</span>
                            Khởi hành từ: Phú Quốc
                        </p>
                        <h3 class="tour-title">
                            Tour Phú Quốc 1 ngày: Trải nghiệm cano 4 đảo
                        </h3>
                        <div class="tour-rating">
                            ★★★★☆
                        </div>
                        <div class="tour-price-row">
                            <span class="tour-price">1.800.000đ</span>
                        </div>
                        <p class="tour-meta-bottom">
                            ⏱ Thời gian: 1N
                        </p>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image">
                        <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Mũi Gành Dầu">
                    </div>
                    <div class="tour-body">
                        <p class="tour-meta-top">
                            <span class="tour-meta-icon">📍</span>
                            Khởi hành từ: HCM
                        </p>
                        <h3 class="tour-title">
                            Mũi Gành Dầu - Làng chài Hàm Ninh - Nhà tù Phú Quốc...
                        </h3>
                        <div class="tour-rating">
                            ★★★★★
                        </div>
                        <div class="tour-price-row">
                            <span class="tour-price">4.500.000đ</span>
                        </div>
                        <p class="tour-meta-bottom">
                            ⏱ Thời gian: 4N3Đ
                        </p>
                    </div>
                </article>
            </div>

            <div class="section-center-btn">
                <a href="#" class="btn-ghost">Xem tất cả</a>
            </div>
        </div>
    </section>

    <!-- 4. TOUR NƯỚC NGOÀI -->
    <section class="section tours">
        <div class="container">
            <div class="section-header-row">
                <div>
                    <h2 class="section-title-lg">Tour nước ngoài</h2>
                    <p class="section-desc">
                        Hơn 1.000 tour đa dạng giá hời có hạn
                    </p>
                </div>
                <div class="tabs">
                    <button class="tab active">Hàn Quốc</button>
                    <button class="tab">Trung Quốc</button>
                    <button class="tab">Thái Lan</button>
                </div>
            </div>

            <div class="tour-list">
                <article class="tour-card">
                    <div class="tour-image">
                        <img src="https://images.pexels.com/photos/237211/pexels-photo-237211.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Seoul mùa đông">
                    </div>
                    <div class="tour-body">
                        <p class="tour-meta-top">
                            <span class="tour-meta-icon">📍</span>
                            Khởi hành từ: Hà Nội
                        </p>
                        <h3 class="tour-title">
                            Du lịch Tết 2024: Hà Nội - Seoul - Nami 5N4Đ
                        </h3>
                        <div class="tour-rating">
                            ★★★★☆
                        </div>
                        <div class="tour-price-row">
                            <span class="tour-price">16.000.000đ</span>
                        </div>
                        <p class="tour-meta-bottom">
                            ⏱ Thời gian: 5N4Đ
                        </p>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image">
                        <img src="https://images.pexels.com/photos/210307/pexels-photo-210307.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Jeju">
                    </div>
                    <div class="tour-body">
                        <p class="tour-meta-top">
                            <span class="tour-meta-icon">📍</span>
                            Khởi hành từ: Hà Nội
                        </p>
                        <h3 class="tour-title">
                            Hà Nội - Hàn Quốc - Đảo Jeju 5N4Đ
                        </h3>
                        <div class="tour-rating">
                            ★★★★★
                        </div>
                        <div class="tour-price-row">
                            <span class="tour-price">15.000.000đ</span>
                        </div>
                        <p class="tour-meta-bottom">
                            ⏱ Thời gian: 5N4Đ
                        </p>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image">
                        <img src="https://images.pexels.com/photos/3768653/pexels-photo-3768653.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Trượt tuyết">
                    </div>
                    <div class="tour-body">
                        <p class="tour-meta-top">
                            <span class="tour-meta-icon">📍</span>
                            Khởi hành từ: HCM
                        </p>
                        <h3 class="tour-title">
                            HCM - Seoul - Dải tuyết Nami 5N4Đ
                        </h3>
                        <div class="tour-rating">
                            ★★★★☆
                        </div>
                        <div class="tour-price-row">
                            <span class="tour-price">15.000.000đ</span>
                        </div>
                        <p class="tour-meta-bottom">
                            ⏱ Thời gian: 5N4Đ
                        </p>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image">
                        <img src="https://images.pexels.com/photos/210307/pexels-photo-210307.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Seoul thu">
                    </div>
                    <div class="tour-body">
                        <p class="tour-meta-top">
                            <span class="tour-meta-icon">📍</span>
                            Khởi hành từ: Hà Nội
                        </p>
                        <h3 class="tour-title">
                            Hà Nội - Seoul - Nami 5N4Đ
                        </h3>
                        <div class="tour-rating">
                            ★★★★★
                        </div>
                        <div class="tour-price-row">
                            <span class="tour-price">12.000.000đ</span>
                        </div>
                        <p class="tour-meta-bottom">
                            ⏱ Thời gian: 5N4Đ
                        </p>
                    </div>
                </article>
            </div>

            <div class="section-center-btn">
                <a href="#" class="btn-ghost">Xem tất cả</a>
            </div>
        </div>
    </section>

    <!-- 5. KHÁCH HÀNG NÓI GÌ -->
    <section class="section testimonials">
        <div class="container">
            <div class="section-heading-center">
                <h2 class="section-title-lg">Khách hàng nói gì về chúng tôi</h2>
                <p class="section-desc">
                    Chúng tôi vinh hạnh vì đã có cơ hội đồng hành với hơn 10.000 khách hàng trên khắp thế giới.
                </p>
            </div>

            <div class="testimonial-grid">
                <article class="testimonial-card">
                    <p class="testimonial-text">
                        "Dịch vụ rất tuyệt vời. Mình đã có một chuyến đi cực kì đáng nhớ. ND Travel đã hỗ trợ
                        rất nhanh khi gặp vấn đề và mình rất đánh giá cao chăm sóc khách hàng."
                    </p>
                    <div class="testimonial-footer">
                        <div>
                            <h4>Nguyễn Minh Anh</h4>
                            <span>Hà Nội</span>
                        </div>
                        <div class="testimonial-stars">★★★★★</div>
                    </div>
                </article>

                <article class="testimonial-card">
                    <p class="testimonial-text">
                        "Lần đầu đi tour trọn gói nên mình hơi lo, nhưng mọi thứ đều trơn tru từ đặt vé, khách
                        sạn đến lịch trình. Hướng dẫn viên nhiệt tình, thân thiện."
                    </p>
                    <div class="testimonial-footer">
                        <div>
                            <h4>Trần Quốc Huy</h4>
                            <span>TP. Hồ Chí Minh</span>
                        </div>
                        <div class="testimonial-stars">★★★★★</div>
                    </div>
                </article>

                <article class="testimonial-card">
                    <p class="testimonial-text">
                        "Gia đình mình có trẻ nhỏ nhưng ND Travel sắp xếp rất hợp lý, thời gian nghỉ ngơi thoải
                        mái. Chắc chắn sẽ tiếp tục đồng hành trong những chuyến đi tới."
                    </p>
                    <div class="testimonial-footer">
                        <div>
                            <h4>Phạm Thu Thảo</h4>
                            <span>Đà Nẵng</span>
                        </div>
                        <div class="testimonial-stars">★★★★☆</div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- 6. CẨM NANG & TIN TỨC -->
    <section class="section blog-news">
        <div class="container blog-news-inner">
            <!-- Cẩm nang -->
            <div class="card-columns">
                <div class="card-columns-header">
                    <button class="pill pill-active">Cẩm nang du lịch</button>
                </div>
                <div class="card-columns-body">
                    <div class="card-columns-main">
                        <img src="https://images.pexels.com/photos/208701/pexels-photo-208701.jpeg?auto=compress&cs=tinysrgb&w=1200"
                            alt="Đà Lạt">
                        <div class="card-columns-main-text">
                            <h3>Du lịch Đà Lạt – Cẩm nang từ A đến Z (update mới nhất)</h3>
                            <p>
                                Chợ Đà Lạt là một trong những khu chợ nổi tiếng, nơi tập trung giao lưu buôn bán
                                với vô vàn món ăn đặc sản hấp dẫn...
                            </p>
                            <a href="#" class="link-more">
                                Tìm hiểu thêm
                                <span>→</span>
                            </a>
                        </div>
                    </div>

                    <ul class="card-columns-list">
                        <li>
                            <img src="https://images.pexels.com/photos/326055/pexels-photo-326055.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Đà Nẵng">
                            <div>
                                <h4>Du lịch Đà Nẵng: Cẩm nang A đến Z</h4>
                                <p>Đầy đủ thông tin về điểm đến, ẩm thực và lưu trú...</p>
                            </div>
                        </li>
                        <li>
                            <img src="https://images.pexels.com/photos/210307/pexels-photo-210307.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Nha Trang">
                            <div>
                                <h4>Du lịch Nha Trang: 13 điểm tham quan hấp dẫn</h4>
                                <p>Danh sách các bãi biển, đảo và địa điểm sống ảo...</p>
                            </div>
                        </li>
                        <li>
                            <img src="https://images.pexels.com/photos/237272/pexels-photo-237272.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Singapore">
                            <div>
                                <h4>Du lịch Singapore: Cẩm nang A đến Z</h4>
                                <p>Hướng dẫn di chuyển, vui chơi, mua sắm tiết kiệm...</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tin tức -->
            <div class="card-columns">
                <div class="card-columns-header">
                    <button class="pill pill-active">Tin tức mới nhất</button>
                </div>
                <div class="card-columns-body">
                    <ul class="card-columns-list card-columns-list--news">
                        <li>
                            <img src="https://images.pexels.com/photos/3586966/pexels-photo-3586966.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="City">
                            <div>
                                <h4>10 thành phố đắt đỏ nhất thế giới 2023</h4>
                                <p>
                                    Báo cáo mới nhất ghi nhận nhiều thay đổi trong bảng xếp hạng các thành phố
                                    đắt đỏ...
                                </p>
                            </div>
                        </li>
                        <li>
                            <img src="https://images.pexels.com/photos/460376/pexels-photo-460376.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Paris">
                            <div>
                                <h4>Trải nghiệm không gian sống sang trọng tại khách sạn 5*</h4>
                                <p>
                                    Khám phá những khu nghỉ dưỡng cao cấp được yêu thích nhất hiện nay...
                                </p>
                            </div>
                        </li>
                        <li>
                            <img src="https://images.pexels.com/photos/237211/pexels-photo-237211.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Yanjin">
                            <div>
                                <h4>Thành phố Yanjin hẹp nhất thế giới</h4>
                                <p>
                                    Một dải đô thị nằm dọc theo dòng sông, mang vẻ đẹp độc đáo và ấn tượng...
                                </p>
                            </div>
                        </li>
                        <li>
                            <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Resort biển">
                            <div>
                                <h4>Top 5 resort biển có ưu đãi đặc biệt</h4>
                                <p>
                                    Gợi ý những khu nghỉ dưỡng lý tưởng cho kỳ nghỉ gia đình, cặp đôi, nhóm
                                    bạn...
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- 7. ĐỒNG HÀNH + NEWSLETTER + FOOTER -->
    <section class="section partners">
        <div class="container partners-inner">
            <h2 class="section-title-lg partners-title">Đồng hành cùng ND Travel</h2>
            <div class="partners-logos">
                <img src="https://bizweb.dktcdn.net/100/505/645/themes/956063/assets/logo_brand1.jpg?1758533840329"
                    alt="Vietnam Airlines">
                <img src="https://bizweb.dktcdn.net/100/505/645/themes/956063/assets/logo_brand2.jpg?1758533840329"
                    alt="Vietjet">
                <img src="https://bizweb.dktcdn.net/100/505/645/themes/956063/assets/logo_brand3.jpg?1758533840329"
                    alt="Jetstar">
                <img src="https://bizweb.dktcdn.net/100/505/645/themes/956063/assets/logo_brand4.jpg?1758533840329"
                    alt="Quatar">
                <img src="https://bizweb.dktcdn.net/100/505/645/themes/956063/assets/logo_brand5.jpg?1758533840329"
                    alt="Vinpearl">
                <img src="https://bizweb.dktcdn.net/100/505/645/themes/956063/assets/logo_brand6.jpg?1758533840329"
                    alt="Ba Na Hills">
            </div>
        </div>
    </section>

    <section class="newsletter">
        <div class="container newsletter-inner">
            <div class="newsletter-text">
                <h3>Theo dõi và cập nhật tin tức mới nhất</h3>
                <p>
                    Vinh hạnh của chúng tôi là mang đến những chuyến đi đáng nhớ. Tự do khám phá cùng ND Travel.
                </p>
            </div>
            <form class="newsletter-form">
                <input type="email" placeholder="Nhập Email của bạn" required>
                <button type="submit">Theo dõi</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="container footer-inner">
            <div class="footer-col">
                <h4>THÔNG TIN LIÊN HỆ</h4>
                <p>Địa chỉ: Tòa nhà Ladeco, 266 Đội Cấn, Ba Đình, Hà Nội</p>
                <p>Email: support@ndtravel.vn</p>
                <p>Hotline: 1900 6750</p>
                <p>08:30 - 21:30 các ngày trong tuần</p>
            </div>
            <div class="footer-col">
                <h4>HƯỚNG DẪN</h4>
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Tour du lịch</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>THÔNG TIN CẦN BIẾT</h4>
                <ul>
                    <li><a href="#">Về chúng tôi</a></li>
                    <li><a href="#">Câu hỏi thường gặp</a></li>
                    <li><a href="#">Điều kiện, điều khoản</a></li>
                    <li><a href="#">Quy chế hoạt động</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>KẾT NỐI</h4>
                <p>Mạng xã hội</p>
                <p>Facebook · Youtube · Instagram</p>
                <p>Tải ứng dụng ND Travel</p>
                <p>App Store · Google Play</p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-inner">
                <span>@ Bản quyền thuộc về ND Travel.</span>
                <span>Thiết kế tham khảo từ ND Travel theme.</span>
            </div>
        </div>
    </footer>

</body>

</html>