<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Community;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $hipHopPosts = [
            ['title' => 'Beat', 'filename' => 'hipHopBeat.mp3', 'tags' => 'Hip Hop,Beat','type' => 'instrumental'],
            ['title' => 'DrumLoop', 'filename' => 'hipHopDrumLoop.mp3', 'tags' => 'Hip Hop,loop,drums,kick,snare' , 'type' => 'instrumental'],
            ['title' => 'Melody', 'filename' => 'hipHopMelody.mp3', 'tags' => 'Hip Hop,Melody,Piano','type' => 'instrumental'],
            ['title' => 'Vocal', 'filename' => 'hipHopVocal.mp3', 'tags' => 'Hip Hop,vocals,bckground,auto-tune','type' => 'vocal'],
            ['title' => 'Song', 'filename' => 'hipHopSong.mp3', 'tags' => 'Hip Hop,Song','type' => 'song']
        ];
        $hipHopOwner = User::create([
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => "hiphop@test.com",
            'password' => '12345678'
        ]);

        $hipHopCommunity = Community::create([
            'owner_id' => $hipHopOwner->id,
            'name' => 'Hip Hop Heads',
            'handle_name' => 'hiphopheads',
            'header_image' => 'communities/header_images/hiphop.jpg',
            'cover_image' => 'communities/cover_images/hiphop.webp',
            'bio' => 'This is  hip hop Community, be civil',
            'description' => "Welcome to the vibrant world of our Hip Hop Music Community!
    
                🎤🔥 Unleash the Rhythm, Embrace the Culture! 🔥🎤
                
                Are you ready to dive headfirst into the heart-pounding beats, electrifying flows, and the creative essence of Hip Hop music? Look no further – you've just landed in the ultimate Hip Hop haven, where the groove never stops and the spirit of the streets comes to life.
                
                🎶 The Beat of the Streets: From Old School to New Wave 🎶
                
                Our community is a melting pot of diverse artists, enthusiasts, and connoisseurs who share a common love for the artistry that is Hip Hop. Whether you're a fan of the classic era that birthed legends like Tupac and Biggie, or you're all about the modern vibes of Kendrick Lamar and Cardi B, there's a place for you here.",
            'tags' => "hip hop,beats,songs,convo"
        ]);
        $hipHopOwner->communities()->toggle($hipHopCommunity);
        $hipHopOwner->posts()->create([
            'community_id' => $hipHopCommunity->id,
            'caption' => "Welcome To Our Community",
        ]); 
        foreach ($hipHopPosts as $index => $post) {
            $username = fake()->userName;
            $user = User::create([
                'name' => fake()->name,
                'username' => $username,
                'email' => $username.'@gmail.com',
                'password' => '12345678',
                
            ]);
            for ($i=0; $i < 10; $i++) { 
                # code...
                $follower = User::create([
                    'name' => fake()->name,
                    'username' => fake()->userName.$i,
                    'email' => fake()->username.$i.'@gmail.com',
                    'password' => fake()->password,
                ]);
                $follower->following()->toggle($user);
                $follower->posts()->create([
                    'caption' => 'Hello I am '.$follower->name,
                ]);

            }
            $user->communities()->toggle($hipHopCommunity);
            $user->following()->toggle($hipHopOwner);
            $user->posts()->create([
                'caption' => 'Hello I am '.$user->name,
            ]);
            $user->posts()->create([
                'community_id' => $hipHopCommunity->id,
                'caption' => 'Hip Hop '.$post['title'],
                'audio_file' => 'audios/'.$post['filename'],
                'tags' => $post['tags'],
                'bpm' => fake()->numberBetween(70,120),
                'genre' => 'Hip Hop',
                'type' => $post['type'],
            ]);
        }
        

        $rnbPosts = [
            ['title' => 'Beat', 'filename' => 'RnbBeat.mp3', 'tags' => 'RnB,Beat','type' => 'instrumental'],
            ['title' => 'DrumLoop', 'filename' => 'RNBdrums.wav', 'tags' => 'RnB,loop,drums,kick,snare' , 'type' => 'instrumental'],
            ['title' => 'Melody', 'filename' => 'RNBPianoKeys.wav', 'tags' => 'RnB,Melody,Piano','type' => 'instrumental'],
            ['title' => 'Vocal', 'filename' => 'rnbVocals.wav', 'tags' => 'RnB,vocals,bckground,auto-tune','type' => 'vocal'],
        ];
        $rnbOwner = User::create([
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => "rnb@test.com",
            'password' => '12345678'
        ]);
        // Create the R&B community
        $rnbCommunity = Community::create([
            'owner_id' => $rnbOwner->id,
            'name' => 'R&B Lovers',
            'handle_name' => 'rnblovers',
            'header_image' => 'communities/header_images/rnb.jpg',
            'cover_image' => 'communities/cover_images/rnb.jpg',
            'bio' => 'Welcome to the R&B Lovers Community. Let the rhythm move you!',
            'description' => "Step into the world of Rhythm and Blues, where soulful melodies and heartfelt lyrics reign supreme.

        🎶 Discover the Soulful Sounds of R&B 🎶

        Are you a fan of classic R&B legends like Marvin Gaye and Whitney Houston, or do you groove to the contemporary beats of artists like Beyoncé and John Legend? No matter your preference, R&B Lovers is your sanctuary for all things soulful and melodious.

        Join us to explore the smooth rhythms, discuss your favorite tracks, and connect with fellow R&B enthusiasts!",
            'tags' => "rnb,love,soul,music"
        ]);
        $rnbOwner->communities()->toggle($rnbCommunity);
        $rnbOwner->posts()->create([
            'community_id' => $rnbCommunity->id,
            'caption' => "Welcome To Our Community",
        ]);
        foreach ($rnbPosts as $index => $post) {
            $username = fake()->userName;
            $user = User::create([
                'name' => fake()->name,
                'username' => $username,
                'email' => $username.'@gmail.com',
                'password' => '12345678',
                
            ]);
            for ($i=0; $i < 10; $i++) { 
                # code...
                $follower = User::create([
                    'name' => fake()->name,
                    'username' => fake()->userName.$i,
                    'email' => fake()->username.$i.'@gmail.com',
                    'password' => fake()->password,
                ]);
                $follower->following()->toggle($user);
                $follower->posts()->create([
                    'caption' => 'Hello I am '.$follower->name,
                ]);
            }
            $user->communities()->toggle($rnbCommunity);
            $user->following()->toggle($rnbOwner);
            $user->posts()->create([
                'caption' => 'Hello I am '.$user->name,
            ]);
            $user->posts()->create([
                'community_id' => $rnbCommunity->id,
                'caption' => 'RnB '.$post['title'],
                'audio_file' => 'audios/'.$post['filename'],
                'tags' => $post['tags'],
                'bpm' => fake()->numberBetween(70,120),
                'genre' => 'RnB',
                'type' => $post['type'],
            ]);
        }



        $trapPosts = [
            ['title' => 'Beat', 'filename' => 'TrapBeat.mp3', 'tags' => 'Trap,Beat','type' => 'instrumental'],
            ['title' => 'DrumLoop', 'filename' => 'TrapDrumLoop.wav', 'tags' => 'Trap,hard,loop,drums,kick,snare' , 'type' => 'instrumental'],
            ['title' => 'SnareRoll', 'filename' => 'TrapSnareRoll.wav', 'tags' => 'Trap,hard,loop,drums,roll,snare' , 'type' => 'instrumental'],
            ['title' => '808s', 'filename' => 'Trap808.wav', 'tags' => 'Trap,hard,loop,drums,808s' , 'type' => 'instrumental'],
            ['title' => 'Melody', 'filename' => 'TrapMelody.wav', 'tags' => 'Trap,Melody,Piano','type' => 'instrumental'],
            ['title' => 'Vocal', 'filename' => 'TrapVocals.wav', 'tags' => 'Trap,vocals,bckground,auto-tune','type' => 'vocal'],
        ];
        $trapMusicOwner = User::create([
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => "trap@test.com",
            'password' => '12345678'
        ]);

        // Create the Trap Music community
        $trapMusicCommunity = Community::create([
            'owner_id' => $trapMusicOwner->id,
            'name' => 'Trap Beats Society',
            'handle_name' => 'trapbeatssociety',
            'header_image' => 'communities/header_images/trap.webp',
            'cover_image' => 'communities/cover_images/trap.webp',
            'bio' => 'Welcome to the Trap Beats Society. Embrace the trap vibes!',
            'description' => "Dive into the world of trap music, where heavy basslines, hard-hitting beats, and gritty lyrics define the sound.

        🎵 Unleash the Trap Vibes 🎵

        Whether you're a fan of iconic trap producers like Metro Boomin and Zaytoven or you're into the latest trap bangers from artists like Travis Scott and Migos, Trap Beats Society is your hub for all things trap.

        Join us to discuss your favorite tracks, share your own beats, and connect with fellow trap music enthusiasts!",
            'tags' => "trap,beats,bass,music"
        ]);
        $trapMusicOwner->communities()->toggle($trapMusicCommunity);
        $trapMusicOwner->posts()->create([
            'community_id' => $trapMusicCommunity->id,
            'caption' => "Welcome To Our Community",
        ]);
        foreach ($trapPosts as $index => $post) {
            $username = fake()->userName;
            $user = User::create([
                'name' => fake()->name,
                'username' => $username,
                'email' => $username.'@gmail.com',
                'password' => '12345678',
                
            ]);
            for ($i=0; $i < 10; $i++) { 
                # code...
                $follower = User::create([
                    'name' => fake()->name,
                    'username' => fake()->userName.$i,
                    'email' => fake()->username.$i.'@gmail.com',
                    'password' => fake()->password,
                ]);
                $follower->following()->toggle($user);
                $follower->posts()->create([
                    'caption' => 'Hello I am '.$follower->name,
                ]);
            }
            $user->communities()->toggle($trapMusicCommunity);
            $user->following()->toggle($trapMusicOwner);
            $user->posts()->create([
                'caption' => 'Hello I am '.$user->name,
            ]);
            $user->posts()->create([
                'community_id' => $trapMusicCommunity->id,
                'caption' => 'Trap '.$post['title'],
                'audio_file' => 'audios/'.$post['filename'],
                'tags' => $post['tags'],
                'bpm' => fake()->numberBetween(70,120),
                'genre' => 'Trap',
                'type' => $post['type'],
            ]);
        }

        $afroPosts = [
            ['title' => 'Shakers', 'filename' => 'AfroPercs.wav', 'tags' => 'Afrobeat,shakers','type' => 'instrumental'],
            ['title' => 'Beat', 'filename' => 'afrobeat.mp3', 'tags' => 'Afrobeat,beat,bass','type' => 'instrumental'],
            ['title' => 'DrumLoop', 'filename' => 'AfroDrumloop.wav', 'tags' => 'Afrobeat,loop,drums' , 'type' => 'instrumental'],
            ['title' => 'Melody', 'filename' => 'Afroguitar.wav', 'tags' => 'Afrobeat,Melody,Guitar','type' => 'instrumental'],
    
        ];
        // Create an owner for the Afro Beats community
        $afroBeatsOwner = User::create([
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => "afrobeats@test.com",
            'password' => '12345678'
        ]);

        // Create the Afro Beats community
        $afroBeatsCommunity = Community::create([
            'owner_id' => $afroBeatsOwner->id,
            'name' => 'Afro Beats Groove',
            'handle_name' => 'afrobeatsgroove',
            'header_image' => 'communities/header_images/afrobeats.jpg',
            'cover_image' => 'communities/cover_images/afrobeats.png',
            'bio' => 'Welcome to the Afro Beats Groove. Let the rhythms of Africa move you!',
            'description' => "Immerse yourself in the captivating world of Afro Beats, where infectious rhythms, vibrant melodies, and rich cultural influences converge.

        🥁 Feel the Pulse of Africa 🥁

        Whether you're a fan of traditional Afro Beats legends like Fela Kuti and Miriam Makeba or you're vibing to the contemporary sounds of Burna Boy and Wizkid, Afro Beats Groove is your gateway to the heart of African music.

        Join us to explore the rhythms of Africa, share your favorite tracks, and connect with fellow Afro Beats enthusiasts!",
            'tags' => "afrobeats,africa,rhythms,music"
        ]);
        $afroBeatsOwner->communities()->toggle($afroBeatsCommunity);
        $afroBeatsOwner->posts()->create([
            'community_id' => $afroBeatsCommunity->id,
            'caption' => "Welcome To Our Community",
        ]);
        foreach ($afroPosts as $index => $post) {
            $username = fake()->userName;
            $user = User::create([
                'name' => fake()->name,
                'username' => $username,
                'email' => $username.'@gmail.com',
                'password' => '12345678',
                
            ]);
            for ($i=0; $i < 10; $i++) { 
                # code...
                $follower = User::create([
                    'name' => fake()->name,
                    'username' => fake()->userName.$i,
                    'email' => fake()->username.$i.'@gmail.com',
                    'password' => fake()->password,
                ]);
                $follower->following()->toggle($user);
                $follower->posts()->create([
                    'caption' => 'Hello I am '.$follower->name,
                ]);
            }
            $user->communities()->toggle($afroBeatsCommunity);
            $user->following()->toggle($afroBeatsOwner);
            $user->posts()->create([
                'caption' => 'Hello I am '.$user->name,
            ]);
            $user->posts()->create([
                'community_id' => $afroBeatsCommunity->id,
                'caption' => 'AfroBeats '.$post['title'],
                'audio_file' => 'audios/'.$post['filename'],
                'tags' => $post['tags'],
                'bpm' => fake()->numberBetween(70,120),
                'genre' => 'AfroBeats',
                'type' => $post['type'],
            ]);
        }




        $drummersPosts = [
            ['title' => 'Hip Hop DrumLoop', 'filename' => 'hipHopDrumLoop.mp3', 'tags' => 'Hip Hop,loop,drums,kick,snare' , 'type' => 'instrumental','genre'=>'Hip Jop'],
            ['title' => 'RNB DrumLoop', 'filename' => 'RNBdrums.wav', 'tags' => 'RnB,loop,drums,kick,snare' , 'type' => 'instrumental','genre'=>'RnB'],
            ['title' => 'Afro Shakers', 'filename' => 'AfroPercs.wav', 'tags' => 'Drums,afrobeat,shakers','type' => 'instrumental','genre'=>'AfroBeat'],
            ['title' => 'Afro Drums', 'filename' => 'afrobeat.mp3', 'tags' => 'Drums,afrobeat,beat,bass','type' => 'instrumental','genre'=>'AfroBeat'],
            ['title' => 'Afro DrumLoop', 'filename' => 'AfroDrumloop.wav', 'tags' => 'Drums,afrobeat,loop,drums' , 'type' => 'instrumental','genre'=>'Afrobeat'],
            ['title' => 'Trap Hard DrumLoop', 'filename' => 'TrapDrumLoop.wav', 'tags' => 'Drums,Trap,hard,kick,snare' , 'type' => 'instrumental','genre'=>'Trap'],
            ['title' => 'Trap SnareRoll', 'filename' => 'TrapSnareRoll.wav', 'tags' => 'Drums,Trap,hard,loop,drums' , 'type' => 'instrumental','genre'=>'Trap'],
    
        ];
        $drummersOwner = User::create([
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => "drummers@test.com",
            'password' => '12345678'
        ]);

        // Create the Drummers community
        $drummersCommunity = Community::create([
            'owner_id' => $drummersOwner->id,
            'name' => 'Drummers Unite',
            'handle_name' => 'drummersunite',
            'header_image' => 'communities/header_images/drummers.jpg',
            'cover_image' => 'communities/cover_images/drummers.jpeg',
            'bio' => 'Welcome to Drummers Unite. Where rhythm and beats come alive!',
            'description' => "Step into the world of drummers, where rhythm, groove, and percussive magic take center stage.

        🥁 Embrace the Beat 🥁

        Whether you're a professional drummer, an aspiring percussionist, or simply a fan of the art, Drummers Unite is your community to discuss drumming techniques, share your drum covers, and connect with fellow rhythm enthusiasts.

        Join us to explore the world of drumming, from traditional rhythms to modern beats!",
            'tags' => "drummers,rhythm,percussion,music"
        ]);
        $drummersOwner->communities()->toggle($drummersCommunity);
        $drummersOwner->posts()->create([
            'community_id' => $drummersCommunity->id,
            'caption' => "Welcome To Our Community",
        ]);
        foreach ($drummersPosts as $index => $post) {
            $username = fake()->userName;
            $user = User::create([
                'name' => fake()->name,
                'username' => $username,
                'email' => $username.'@gmail.com',
                'password' => '12345678',
                
            ]);
            for ($i=0; $i < 10; $i++) { 
                # code...
                $follower = User::create([
                    'name' => fake()->name,
                    'username' => fake()->userName.$i,
                    'email' => fake()->username.$i.'@gmail.com',
                    'password' => fake()->password,
                ]);
                $follower->following()->toggle($user);
                $follower->posts()->create([
                    'caption' => 'Hello I am '.$follower->name,
                ]);
            }
            $user->communities()->toggle($drummersCommunity);
            $user->following()->toggle($drummersOwner);
            $user->posts()->create([
                'caption' => 'Hello I am '.$user->name,
            ]);
            $user->posts()->create([
                'community_id' => $drummersCommunity->id,
                'caption' => $post['title'],
                'audio_file' => 'audios/'.$post['filename'],
                'tags' => $post['tags'],
                'bpm' => fake()->numberBetween(70,120),
                'genre' => $post['genre'],
                'type' => $post['type'],
            ]);
        }


        $guitaristsPosts = [
            ['title' => 'Hip Hop Guitar', 'filename' => 'Guitar.wav', 'tags' => 'Guitar,Melody,Hip Hop' , 'type' => 'instrumental','genre'=>'Hip Jop'],
            ['title' => 'Afro Guitar', 'filename' => 'Afroguitar.wav', 'tags' => 'Guitar,Melody,afrobeat','type' => 'instrumental','genre'=>'AfroBeat'],    
        ];
        $guitaristsOwner = User::create([
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => "guitarists@test.com",
            'password' => '12345678'
        ]);

        // Create the Guitarists community
        $guitaristsCommunity = Community::create([
            'owner_id' => $guitaristsOwner->id,
            'name' => 'Guitarists United',
            'handle_name' => 'guitaristsunited',
            'header_image' => 'communities/header_images/guitarists.jpg',
            'cover_image' => 'communities/cover_images/guitarists.jpg',
            'bio' => 'Welcome to Guitarists United. Strum, pick, and shred together!',
            'description' => "Enter the realm of guitarists, where strings and melodies blend into a harmonious symphony.

        🎸 Join the Jam Session 🎸

        Whether you're an acoustic fingerpicker, an electric shredder, or anything in between, Guitarists United is your community to discuss guitar techniques, share your covers, and connect with fellow guitar enthusiasts.

        Join us to explore the world of guitar, from classic rock riffs to intricate fingerstyle compositions!",
            'tags' => "guitarists,guitar,music,shredding"
        ]);
        $guitaristsOwner->communities()->toggle($guitaristsCommunity);
        $guitaristsOwner->posts()->create([
            'community_id' => $guitaristsCommunity->id,
            'caption' => "Welcome To Our Community",
        ]);
        foreach ($guitaristsPosts as $index => $post) {
            $username = fake()->userName;
            $user = User::create([
                'name' => fake()->name,
                'username' => $username,
                'email' => $username.'@gmail.com',
                'password' => '12345678',
                
            ]);
            for ($i=0; $i < 10; $i++) { 
                # code...
                $follower = User::create([
                    'name' => fake()->name,
                    'username' => fake()->userName.$i,
                    'email' => fake()->username.$i.'@gmail.com',
                    'password' => fake()->password,
                ]);
                $follower->following()->toggle($user);
                $follower->posts()->create([
                    'caption' => 'Hello I am '.$follower->name,
                ]);
            }
            $user->communities()->toggle($guitaristsCommunity);
            $user->following()->toggle($guitaristsOwner);
            $user->posts()->create([
                'caption' => 'Hello I am '.$user->name,
            ]);
            $user->posts()->create([
                'community_id' => $guitaristsCommunity->id,
                'caption' => $post['title'],
                'audio_file' => 'audios/'.$post['filename'],
                'tags' => $post['tags'],
                'bpm' => fake()->numberBetween(70,120),
                'genre' => $post['genre'],
                'type' => $post['type'],
            ]);
        }



        $pianistsPosts = [
            ['title' => '', 'filename' => 'pianoLoops.wav', 'tags' => 'Hip Hop,loop,drums,kick,snare' , 'type' => 'instrumental','genre'=>'Hip Hop'],
            ['title' => 'Soft Piano Keys', 'filename' => 'RNBPianoKeys.wav', 'tags' => 'Piano,Melody,Soft,Lo-fi' , 'type' => 'instrumental','genre'=>'Lo-Gi'],
            ['title' => 'Trap piano Melody', 'filename' => 'hipHopMelody.mp3', 'tags' => 'Piano,Trap,Melody','type' => 'instrumental','genre'=>'Trap'],
            ['title' => 'Trap Dark Piano', 'filename' => 'TrapPiano.wav', 'tags' => 'Piano,Trap,dark,Melody' , 'type' => 'instrumental','genre'=>'Trap'],    
        ];
        $pianistsOwner = User::create([
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => "pianists@test.com",
            'password' => '12345678'
        ]);

        // Create the Pianists community
        $pianistsCommunity = Community::create([
            'owner_id' => $pianistsOwner->id,
            'name' => 'Piano Enthusiasts',
            'handle_name' => 'pianoenthusiasts',
            'header_image' => 'communities/header_images/pianists.jpg',
            'cover_image' => 'communities/cover_images/pianists.jpg',
            'bio' => 'Welcome to Piano Enthusiasts. Let the keys inspire you!',
            'description' => "Immerse yourself in the world of pianists, where ivory keys create enchanting melodies.

        🎹 Explore the Piano's Magic 🎹

        Whether you're a classical pianist, a jazz improviser, or simply passionate about the instrument, Piano Enthusiasts is your community to discuss piano techniques, share your compositions, and connect with fellow piano enthusiasts.

        Join us to explore the versatile world of piano music, from Chopin's nocturnes to contemporary jazz standards!",
            'tags' => "pianists,piano,music,keys"
        ]);
        $pianistsOwner->communities()->toggle($pianistsCommunity);
        $pianistsOwner->posts()->create([
            'community_id' => $pianistsCommunity->id,
            'caption' => "Welcome To Our Community",
        ]);
        foreach ($pianistsPosts as $index => $post) {
            $username = fake()->userName;
            $user = User::create([
                'name' => fake()->name,
                'username' => $username,
                'email' => $username.'@gmail.com',
                'password' => '12345678',
                
            ]);
            for ($i=0; $i < 10; $i++) { 
                # code...
                $follower = User::create([
                    'name' => fake()->name,
                    'username' => fake()->userName.$i,
                    'email' => fake()->username.$i.'@gmail.com',
                    'password' => fake()->password,
                ]);
                $follower->following()->toggle($user);
                $follower->posts()->create([
                    'caption' => 'Hello I am '.$follower->name,
                ]);
            }
            $user->communities()->toggle($pianistsCommunity);
            $user->following()->toggle($pianistsOwner);
            $user->posts()->create([
                'caption' => 'Hello I am '.$user->name,
            ]);
            $user->posts()->create([
                'community_id' => $pianistsCommunity->id,
                'caption' => $post['title'],
                'audio_file' => 'audios/'.$post['filename'],
                'tags' => $post['tags'],
                'bpm' => fake()->numberBetween(70,120),
                'genre' => $post['genre'],
                'type' => $post['type'],
            ]);
        }



        // for ($index = 0; $index < 50; $index++) {
        //     # code...
        //     $user = User::create([
        //         'name' => fake()->name,
        //         'username' => fake()->userName,
        //         'email' => "test{$index}@gmail.com",
        //         'password' => '12345678',

        //     ]);
        //     $user->communities()->toggle($hipHopCommunity);
        //     $user->communities()->toggle($rnbCommunity);
        //     $user->communities()->toggle($trapMusicCommunity);
        //     $user->communities()->toggle($afroBeatsCommunity);
        //     $user->communities()->toggle($guitaristsCommunity);
        //     $user->communities()->toggle($pianistsCommunity);
        //     $user->communities()->toggle($drummersCommunity);
        // }
    }
}
