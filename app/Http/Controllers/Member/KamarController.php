public function show(Kamar $kamar)
    {
        return view('member.kamar.show', compact('kamar'));
    }
=======
    // Show kamar detail
    public function show(Kamar $kamar)
    {
        $kamar->load(['tipe', 'reviews.user']);
        return view('member.kamar.show', compact('kamar'));
    }
