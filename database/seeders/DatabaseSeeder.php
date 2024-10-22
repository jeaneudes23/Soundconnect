<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\Community;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    

    public function run(): void
    {
       $afroSongs = ['audios/ab.mp3'];
       $rnbInstrumentals = ['audios/rb.mp3'];
       $hipHopInstrumentals = ['audios/hh1.mp3','audios/hh2.mp3','audios/hh3.mp3'];

       $hipHopOwner = User::create([
        'name' => fake()->name,
        'username' =>fake()->userName,
        'email' => "hiphop@test.com",
        'password' => '12345678'
       ]);

        $hipHopCommunity = Community::create([
            'owner_id' => $hipHopOwner->id,
            'name' => 'Hip Hop Heads',
            'handle_name' => 'hiphopheads',
            'bio' => 'This is  hip hop Community, be civil',
            'description' => "Welcome to the vibrant world of our Hip Hop Music Community!

            🎤🔥 Unleash the Rhythm, Embrace the Culture! 🔥🎤
            
            Are you ready to dive headfirst into the heart-pounding beats, electrifying flows, and the creative essence of Hip Hop music? Look no further – you've just landed in the ultimate Hip Hop haven, where the groove never stops and the spirit of the streets comes to life.
            
            🎶 The Beat of the Streets: From Old School to New Wave 🎶
            
            Our community is a melting pot of diverse artists, enthusiasts, and connoisseurs who share a common love for the artistry that is Hip Hop. Whether you're a fan of the classic era that birthed legends like Tupac and Biggie, or you're all about the modern vibes of Kendrick Lamar and Cardi B, there's a place for you here.",
            'tags' => "hip hop,beats,songs,convo"
        ]);

       $rnbOwner = User::create([
        'name' => fake()->name,
        'username' =>fake()->userName,
        'email' => "rnb@test.com",
        'password' => '12345678'
       ]);

        $rnbCommunity = Community::create([
            'owner_id' => $rnbOwner->id,
            'name' => 'RnB Heads',
            'handle_name' => 'rnbheads',
            'bio' => 'This is  RnB Community, be civil',
            'description' => "🎶🎤 Where Rhythm and Soul Converge 🎤🎶

            Step into a world where melodies soothe the soul, lyrics tell stories of love and life, and the R&B community comes together as one harmonious family. Whether you're a die-hard fan or an artist ready to pour your heart into the music, you've found your home.
            
            🎵 Feel the Groove: From Classic Vibes to Modern Flows 🎵
            
            Our R&B community is a sanctuary for those who appreciate the timeless classics of legends like Marvin Gaye and Whitney Houston, as well as those who vibe with the contemporary sounds of artists like Beyoncé and Frank Ocean. Here, the music takes center stage, and your heart finds its rhythm.
            
            🎤 Where Voices Shine: A Platform for Artists and Enthusiasts 🎤
            
            Are you an artist with lyrics that paint emotions, a producer crafting beats that move the soul, or a dedicated fan who lives and breathes R&B? Welcome to a platform that celebrates your creativity and passion. Share your music, exchange thoughts on your favorite tracks, and collaborate with fellow artists who speak the language of rhythm and soul.
            
            🌟 More Than Music: Fashion, Culture, and Lifestyle 🌟
            
            R&B is more than just music; it's a cultural movement that shapes fashion, influences art, and intertwines with everyday life. Engage in discussions about iconic fashion trends, explore how R&B resonates in visual arts, and discover how the culture weaves its magic in your day-to-day experiences.
            
            💬 Connect and Elevate: Unity in Harmony 💬
            
            Our R&B Community thrives on unity, appreciation, and collaboration. Connect with like-minded enthusiasts, share your insights on the evolution of R&B, or team up for virtual jam sessions that transcend distances. Whether you're a seasoned artist or a fan spreading love, this is where bonds are formed and dreams come to life.
            
            📚 Championing the Legacy: Embrace the History of R&B 📚
            
            Delve into the history of R&B, from its roots to its modern-day manifestations. Learn about the trailblazers who paved the way, discuss how R&B has influenced social change, and celebrate the artists who have made their mark on our hearts.
            
            🔔 Stay in the Groove: Updates and Exclusive Content 🔔
            
            Be the first to know about album releases, music videos, and exclusive content drops from your favorite R&B artists. Our community keeps you in the loop, ensuring you're always connected to the soulful melodies that define R&B.
            
            So, whether you're here to share your beats, immerse yourself in timeless tracks, or simply revel in the soulful spirit of R&B, welcome to our R&B Community! Let the music be your guide, the rhythms be your heartbeat, and the community be your extended family. Let's keep the groove alive! 🎶🌟",
            'tags' => "RNB,beats,songs,convo"
        ]);

       $afroOwner = User::create([
        'name' => fake()->name,
        'username' =>fake()->userName,
        'email' => "afro@test.com",
        'password' => '12345678'
       ]);

        $afroCommunity = Community::create([
            'owner_id' => $afroOwner->id,
            'name' => 'afro Heads',
            'handle_name' => 'afroheads',
            'bio' => 'This is  Afro Community, be civil',
            'description' => "🎶🎤 Where Rhythm and Soul Converge 🎤🎶

            Step into a world where melodies soothe the soul, lyrics tell stories of love and life, and the R&B community comes together as one harmonious family. Whether you're a die-hard fan or an artist ready to pour your heart into the music, you've found your home.
            
            🎵 Feel the Groove: From Classic Vibes to Modern Flows 🎵
            
            Our R&B community is a sanctuary for those who appreciate the timeless classics of legends like Marvin Gaye and Whitney Houston, as well as those who vibe with the contemporary sounds of artists like Beyoncé and Frank Ocean. Here, the music takes center stage, and your heart finds its rhythm.
            
            🎤 Where Voices Shine: A Platform for Artists and Enthusiasts 🎤
            
            Are you an artist with lyrics that paint emotions, a producer crafting beats that move the soul, or a dedicated fan who lives and breathes R&B? Welcome to a platform that celebrates your creativity and passion. Share your music, exchange thoughts on your favorite tracks, and collaborate with fellow artists who speak the language of rhythm and soul.
            
            🌟 More Than Music: Fashion, Culture, and Lifestyle 🌟
            
            R&B is more than just music; it's a cultural movement that shapes fashion, influences art, and intertwines with everyday life. Engage in discussions about iconic fashion trends, explore how R&B resonates in visual arts, and discover how the culture weaves its magic in your day-to-day experiences.
            
            💬 Connect and Elevate: Unity in Harmony 💬
            
            Our R&B Community thrives on unity, appreciation, and collaboration. Connect with like-minded enthusiasts, share your insights on the evolution of R&B, or team up for virtual jam sessions that transcend distances. Whether you're a seasoned artist or a fan spreading love, this is where bonds are formed and dreams come to life.
            
            📚 Championing the Legacy: Embrace the History of R&B 📚
            
            Delve into the history of R&B, from its roots to its modern-day manifestations. Learn about the trailblazers who paved the way, discuss how R&B has influenced social change, and celebrate the artists who have made their mark on our hearts.
            
            🔔 Stay in the Groove: Updates and Exclusive Content 🔔
            
            Be the first to know about album releases, music videos, and exclusive content drops from your favorite R&B artists. Our community keeps you in the loop, ensuring you're always connected to the soulful melodies that define R&B.
            
            So, whether you're here to share your beats, immerse yourself in timeless tracks, or simply revel in the soulful spirit of R&B, welcome to our R&B Community! Let the music be your guide, the rhythms be your heartbeat, and the community be your extended family. Let's keep the groove alive! 🎶🌟",
            'tags' => "afro,beats,songs,convo"
        ]);
        
      
        foreach (range(1, 10) as $index) {
            $user = User::create([
                'name' => fake()->name,
                'username' => fake()->userName,
                'email' => "test{$index}@test.com",
                'password' => '12345678',
                
            ]);

            Post::create([
                'user_id' => $user->id,
                'community_id' => $hipHopCommunity->id,
                'caption' => fake()->sentence,
                'audio_file' => fake()->randomElement($hipHopInstrumentals),
                'tags' => 'instrumental,hipHop,music,slow,bass',
                'bpm' => fake()->numberBetween(50,170),
                'genre' => 'hipHop',
                'type' => 'instrumental',
            ]);

            Post::create([
                'user_id' => $user->id,
                'community_id' => $rnbCommunity->id,
                'caption' => fake()->sentence,
                'audio_file' => fake()->randomElement($rnbInstrumentals),
                'tags' => 'instrumental,rnb,music,slow,bass',
                'bpm' => fake()->numberBetween(50,170),
                'genre' => 'RNB',
                'type' => 'instrumental',
            ]);

            Post::create([
                'user_id' => $user->id,
                'community_id' => $afroCommunity->id,
                'caption' => fake()->sentence,
                'audio_file' => fake()->randomElement($afroSongs),
                'tags' => 'rnb,music,slow,bass',
                'bpm' => fake()->numberBetween(50,170),
                'genre' => 'AFRO',
                'type' => 'song',
            ]);
            Post::create([
                'user_id' => $user->id,
                'community_id' => $afroCommunity->id,
                'caption' => fake()->sentence,
                'type' => 'text',
            ]);

            Post::create([
                'user_id' => $user->id,
                'caption' => fake()->sentence,
                'type' => 'text',
            ]);
            Post::create([
                'user_id' => $user->id,
                'caption' => fake()->sentence,
                'type' => 'text',
            ]);
            

       
        }
 

        User::create([
          'name' => 'Admin',
          'email' => 'admin@test.com',
          'password' => Hash::make('password'),
          'role' => 'admin',
        ]);
    }
}
