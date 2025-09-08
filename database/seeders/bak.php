        // Schema::create('book_categories', function (Blueprint $table) {
        // $table->id();
        // $table->string('name')->unique();
        // $table->text('description')->nullable();
        // $table->timestamps();
        // $table->softDeletes();
        // });

        // Schema::create('books', function (Blueprint $table) {
        // $table->id();
        // $table->string('title');
        // $table->foreignId('category_id')->constrained('book_categories')->onDelete('cascade');
        // $table->string('author');
        // $table->string('isbn')->unique();
        // $table->year('publication_year');
        // $table->string('publisher');
        // $table->integer('quantity');
        // $table->text('description')->nullable();
        // $table->string('cover_image')->nullable();
        // $table->longText('content')->nullable();
        // $table->timestamps();
        // $table->softDeletes();
        // });

        // Schema::create('events', function (Blueprint $table) {
        // $table->id();
        // $table->string('title');
        // $table->text('description');
        // $table->date('date');
        // $table->time('start_time');
        // $table->time('end_time')->nullable();
        // $table->string('location')->nullable();
        // $table->enum('type', ['academic', 'cultural', 'sports', 'holiday', 'other']);
        // $table->boolean('is_holiday')->default(false);
        // $table->timestamps();
        // $table->softDeletes();
        // });

        // Schema::create('book_issues', function (Blueprint $table) {
        // $table->id();
        // $table->foreignId('book_id')->constrained()->onDelete('cascade');
        // $table->foreignId('student_id')->nullable()->constrained()->onDelete('set null');
        // $table->foreignId('teacher_id')->nullable()->constrained()->onDelete('set null');
        // $table->date('issue_date');
        // $table->date('due_date');
        // $table->date('return_date')->nullable();
        // $table->decimal('fine', 8, 2)->default(0);
        // $table->enum('status', ['issued', 'returned', 'overdue'])->default('issued');
        // $table->timestamps();
        // $table->softDeletes();
        // });

        // Schema::create('notices', function (Blueprint $table) {
        // $table->id();
        // $table->string('title');
        // $table->text('content');
        // $table->enum('audience', ['all', 'teachers', 'students', 'parents', 'staff']);
        // $table->date('start_date');
        // $table->date('end_date');
        // $table->boolean('is_published')->default(false);
        // $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
        // $table->timestamps();
        // $table->softDeletes();
        // });

        // Schema::create('provinces', function (Blueprint $table) {
        // $table->id();
        // $table->string('type');
        // $table->string('code');
        // $table->string('khmer_name');
        // $table->string('name');
        // $table->timestamps();
        // });

        // Schema::create('districts', function (Blueprint $table) {
        // $table->id();
        // $table->string('type');
        // $table->string('code');
        // $table->string('khmer_name');
        // $table->string('name');
        // $table->unsignedBigInteger('province_id');
        // $table->timestamps();
        // $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        // });

        // Schema::create('communes', function (Blueprint $table) {
        // $table->id();
        // $table->string('type');
        // $table->string('code');
        // $table->string('khmer_name');
        // $table->string('name');
        // $table->unsignedBigInteger('province_id');
        // $table->unsignedBigInteger('district_id');
        // $table->timestamps();
        // $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        // $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        // });

        // Schema::create('villages', function (Blueprint $table) {
        // $table->id();
        // $table->string('type');
        // $table->string('code');
        // $table->string('khmer_name');
        // $table->string('name');
        // $table->unsignedBigInteger('province_id');
        // $table->unsignedBigInteger('district_id');
        // $table->unsignedBigInteger('commune_id');
        // $table->timestamps();
        // $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        // $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        // $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
        // });

        // Schema::create('addresses', function (Blueprint $table) {
        // $table->id();
        // $table->unsignedBigInteger('province_id');
        // $table->unsignedBigInteger('district_id');
        // $table->unsignedBigInteger('commune_id');
        // $table->unsignedBigInteger('village_id');

        // $table->string('description')->nullable();
        // $table->enum('status', ['active', 'inactive'])->default('active');
        // $table->timestamps();
        // $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        // $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        // $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
        // $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
        // });