<!--
    Final Project ~ CPSC 314-01 (Web Development)
	Elizabeth Larson
    Last Modified: 12/06/2020
    Sources:
        Using Modals (More Info Pop-Up): https://www.w3schools.com/howto/howto_css_modals.asp
        Passing array from PHP to Javascript file: https://stackoverflow.com/questions/27918653/pass-php-arrays-to-external-javascript-file
        Updating based on JavaScript book id: https://stackoverflow.com/questions/9789283/how-to-get-javascript-variable-value-in-php

	Logic for reading from and updating the database, as well as creating HTML elements to be used in other files.
    Uses prepared statements for safe INSERTing into the database (should it be empty).
-->

<!-- Reading -->
<?php
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "BookFinder";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if there are any books in the database already, and if not, populate it
    $sql = "SELECT * FROM Book";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Don't add anything because the database is already populated
    } else { // Otherwise, the table has nothing in it
        // Insert books into the database (with an error message is something goes wrong)
        // Use prepared statements so the information isn't being embedded in the query string
        $sqlInsert = "INSERT INTO Book (title, author, topic, summary, cover_url, is_in_reading_list) VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = mysqli_prepare($conn, $sqlInsert)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $title, $author, $topic, $summary, $cover_url, $is_in_reading_list);
            
            $title = "Same, Same But Different";
            $author = "Jenny Sue Kostecki-Shaw";
            $topic = "Diversity";
            $summary = "Same, Same But Different shares the story of two best friends who live in different parts of the world – one in America, the other in India. Young readers learn how people who people are similar even though their worlds may seem completely different.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/61q8GWczFJL._SX492_BO1,204,203,200_.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);
            
            $title = "People";
            $author = "Peter Spier";
            $topic = "Diversity";
            $summary = "People uses detailed pictures to teach readers about the differences and similarities between people around the world. It introduces kids to different cultures, religions and lifestyle in different parts of the world.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/61ytI-pOzFL._SX372_BO1,204,203,200_.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Stick and Stone";
            $author = "Beth Ferry and Tom Lichtenheld";
            $topic = "Bullying";
            $summary = "True friends stick up for one another, even when it’s a little bit scary.";
            $cover_url = "https://s18670.pcdn.co/wp-content/uploads/Stick-and-Stone.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Chrysanthemum";
            $author = "Kevin Henkes";
            $topic = "Bullying";
            $summary = "A popular picture book, Chrysanthemum is a story about teasing, self-esteem, and acceptance. It has sold more than a million copies and was named a Notable Book for Children by the American Library Association.";
            $cover_url = "https://s18670.pcdn.co/wp-content/uploads/2016/07/chrysanthemum.tmb-blogs-3x25.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Visiting Day";
            $author = "Jacqueline Woodson";
            $topic = "Incarcerated Family Member";
            $summary = "The moving story of a young girl and her grandmother preparing for their monthly trip to visit the girl’s father in prison. Award-winning and gorgeously illustrated.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/A1km23GGMRL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Amber Was Brave, Essie Was Smart";
            $author = "Vera B. Williams";
            $topic = "Incarcerated Family Member";
            $summary = "A mix of poetry and illustrations telling the story of two bright, self-sufficient girls, who are more than able to care for themselves despite their working mother and incarcerated father.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/513bLrWrjQL._SX334_BO1,204,203,200_.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Too Shy for Show-and-Tell";
            $author = "Beth Bracken";
            $topic = "Shyness";
            $summary = "Sam is so shy that nobody knows much about him, but when he must stand in front of his class for show-and-tell, he finds the courage to share.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/51f1-1YkSXL._SX258_BO1,204,203,200_.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "A Way with Wild Things";
            $author = "Larissa Theule";
            $topic = "Shyness";
            $summary = "Poppy’s not flashy, but she stands out in her own way. This charming book about a girl who loves nature celebrates quieter kids.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/91miBJEEnML.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Nobody Hugs A Cactus";
            $author = "Carter Goodrich";
            $topic = "Loneliness";
            $summary = "Celebrated artist and lead character designer of Brave, Ratatouille, and Despicable Me, Carter Goodrich, shows that sometimes, even the prickliest people—or the crankiest cacti—need a little love. Hank is the prickliest cactus in the entire world. He sits in a pot in a window that faces the empty desert, which is just how he likes it. So, when all manner of creatures—from tumbleweed to lizard to owl—come to disturb his peace, Hank is annoyed. He doesn’t like noise, he doesn’t like rowdiness, and definitely does not like hugs. But the thing is, no one is offering one. Who would want to hug a plant so mean? Hank is beginning to discover that being alone can be, well, lonely. So he comes up with a plan to get the one thing he thought he would never need: a hug from a friend.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/81wAt+IHM4L.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Teacup";
            $author = "Rebecca Young";
            $topic = "Loneliness";
            $summary = "A boy must leave his home and find another. He brings with him a teacup full of earth from the place where he grew up, and sets off to sea. Some days, the journey is peaceful, and the skies are cloudless and bright. Some days, storms threaten to overturn his boat. And some days, the smallest amount of hope grows into something glorious. At last, the boy finds land, but it doesn’t feel complete . . . until another traveler joins him, bearing the seed to build a new home.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/91yBDBNOR5L.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Coronavirus: A Book for Children";
            $author = "Elizabeth Jenner, Kate Wilson, and Nia Roberts";
            $topic = "COVID-19";
            $summary = "This informative and accessible guide for young readers defines the coronavirus, explains why everyday routines have been disrupted, and lays out how everyone can do their part to help. With child-appropriate answers and explanations, the book addresses several key questions.";
            $cover_url = "https://nhfv.org/wp-content/uploads/2020/04/coronavirus-a-book-for-children-cover-271x300.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "My Hero is You: Storybook for Children on COVID-19 ";
            $author = "The Inter-Agency Standing Committee (IASC)";
            $topic = "COVID-19";
            $summary = "Features a creature named Ario, who helps explain how children can protect against the virus and cope with the complicated emotions around the world dealing with a pandemic, according to a release from the Inter-Agency Standing Committee (IASC), which is part of the United Nations Office for the Coordination of Humanitarian Affairs. This book is available in 29 languages.";
            $cover_url = "https://nhfv.org/wp-content/uploads/2020/04/My-hero-is-you-cover-300x210.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Glad Monster, Sad Monster";
            $author = "Ed Emberley and Anne Miranda";
            $topic = "Emotional and Mental Health";
            $summary = "If you’re looking for an interactive way to teach your little one about emotions, Glad Monster, Sad Monster is it as it walks you and your child through all the moods of little monsters (and kids!).";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/91geoUGDJiL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "My Many Colored Days";
            $author = "Dr. Seuss";
            $topic = "Emotional and Mental Health";
            $summary = "You can’t go wrong with a Dr. Seuss children’s book about mental health. My Many Colored Days is great for children learning about their emotions and it can be used as they grow to open up communication about the way they feel.";
            $cover_url = "https://prodimage.images-bn.com/pimages/9780679875970_p0_v1_s1200x630.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Separate Is Never Equal: Sylvia Mendez and Her Family’s Fight for Desegregation";
            $author = "Duncan Tonatiuh";
            $topic = "Racism and Discrimination";
            $summary = "In 1944 Sylvia Mendez, an American citizen of Mexican and Puerto Rican heritage who spoke and wrote perfect English, was denied enrollment to a 'Whites only' school. With the help of the Hispanic community, her parents filed and won a lawsuit in federal district court. Their success eventually led to the end of segregated education in California. Separate Is Never Equal tells Sylvia’s story in a touching and accessible way.";
            $cover_url = "https://coloursofus.com/wp-content/uploads/2017/08/612BDUdFaUSL.SL160.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "The Story Of Ruby Bridges";
            $author = "Robert Coles";
            $topic = "Racism and Discrimination";
            $summary = "In 1960 a judge orders little Ruby to attend first grade at William Frantz Elementary, an all-white school in New Orleans. Surrounded by Federal Marshalls, Ruby faces angry mobs of segregationists as she walks through the school door on her first day (and many after). Being the only student in her class she is taught by a supportive teacher. With simple text and engaging watercolour illustrations, The Story of Ruby Bridges is a moving picture book about a little girl’s calm perseverance and gracious forgiveness in the ugly face of hate and racism.";
            $cover_url = "https://coloursofus.com/wp-content/uploads/2016/04/511ipO06XsL.SL160.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "The Deaf Musicians";
            $author = "Pete Seeger";
            $topic = "Disabilities";
            $summary = "Lee, a jazz pianist, has to leave his band when he begins losing his hearing, but he meets a deaf saxophone player in a sign language class and together they form a snazzy new band.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/91vSWOJy-BL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "My Brother Charlie";
            $author = "Holly Robinson Peete";
            $topic = "Disabilities";
            $summary = "A girl tells what it is like living with her twin brother who has autism and sometimes finds it hard to communicate with words, but who, in most ways, is just like any other boy. Includes authors' note about autism.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/81niArxSMbL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Maybe Days";
            $author = "Jennifer Wilgocki and Marcia Kahn Wright";
            $topic = "Foster Care";
            $summary = "For many children in foster care, the answer to many questions is often maybe. Maybe Days is a straightforward look at the issues of foster care, the questions that children ask, and the feelings that they confront. A primer for children going into foster care, the book also explains in children’s terms the responsibilities of everyone involved – parents, social workers, lawyers and judges. As for the children themselves, their job is to be a kid – and there’s no maybe about that.";
            $cover_url = "https://s2982.pcdn.co/wp-content/uploads/2016/05/Maybe-Days-by-Jennifer-Wilgocki-Marcia-Kahn-Wright-Alissa-Imre-Geis.jpg.optimal.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Families Change: A Book for Children Experiencing Termination of Parental Rights";
            $author = "Julie Nelson";
            $topic = "Foster Care";
            $summary = "All families change over time. Sometimes a baby is born, or a grown-up gets married. And sometimes a child gets a new foster parent or a new adopted mom or dad. Children need to know that when this happens, it’s not their fault. They need to understand that they can remember and value their birth family and love their new family, too. Straightforward words and full-color illustrations offer hope and support for children facing or experiencing change. Includes resources and information for birth parents, foster parents, social workers, counselors, and teachers.";
            $cover_url = "https://s2982.pcdn.co/wp-content/uploads/2016/05/Families-Change-A-Book-for-Children-Experiencing-Termination-of-Parental-Rights-by-Julie-Nelson.jpg.optimal.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "The Unbudgeable Curmudgeon";
            $author = "Matthew Burgess";
            $topic = "Sibling Rivalry";
            $summary = "Sometimes your brother or sister is so incorrigibly grumpy, there’s no better word for it than a curmudgeon. In Matthew Burgess’s playful take on bad moods and determined siblings, a young girl tries to bribe and budge her brother out of his funk — only to become so frustrated, she becomes curmudgeonly herself. This one starts helpful conversations about how to interact with a grouchy sibling.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/51bakxh0GbL._SX258_BO1,204,203,200_.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "The Evil Princess vs. the Brave Knight";
            $author = "Jennifer L. Holm";
            $topic = "Sibling Rivalry";
            $summary = "In this delightful picture book, written and illustrated by sibling team Jennifer and Matthew Holm, an 'evil princess' and a 'brave knight' share a castle together — and take their right to torture one another seriously! Though it seems like it's their sole mission to wreak havoc, can the Magic Mirror get them to play nice?";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/91LUAAMWXlL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "My Two Homes";
            $author = "Claudia Harrington and Zoe Persico";
            $topic = "Divorce";
            $summary = "Lenny follows Skye to her home for a school project, only to discover that she actually has two homes and a great relationship with all her parents ­– father, mother, and stepfather. The book is very upbeat, and presents post-divorce life as normal and even fun.";
            $cover_url = "https://s2982.pcdn.co/wp-content/uploads/2019/01/My-Two-Homes_Claudia-Harrington.jpg.optimal.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Always Mom, Forever Dad";
            $author = "Joanna Rowland and Penny Weber";
            $topic = "Divorce";
            $summary = "No real narrative in this one, just comforting sentiments from the point of view of well-adjusted children. Each vignette is about a different family, normalizing divorce for the reader and showing the reader that it can happen to anyone. The cozy art shows a nice range of families from different races and areas.";
            $cover_url = "https://s2982.pcdn.co/wp-content/uploads/2019/01/Always-Mom-Forever-Dad_Joanna-Rowland.jpg.optimal.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Bird, Balloon, Bear";
            $author = "Il Sung Na";
            $topic = "Friendship";
            $summary = "Bird would love to make a friend in his new forest home, but unfortunately he’s very shy. He’s mustering the bravery to approach Bear, when it becomes obvious that Bear has just filled his friend vacancy – with a giant red balloon. Bird is disheartened, but patiently keeps hanging around and being available. When the balloon meets an explosive end, the timing is finally right, and Bird and Bear form a wonderful friendship.";
            $cover_url = "https://www.readings.com.au/system/uploads/assets/0004/5590/ee9d6362a5315a02c96fbdc13c098b2c.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "The Conversation Train";
            $author = "Joel Shaul";
            $topic = "Friendship";
            $summary = "Making a connection using words and conversation is so important in the early stages of a friendship, but it’s not always the easiest or most intuitive skill to master. This innovative book – part picture book, part activity book – uses colourful pictures of train engines, carriages and tracks to demonstrate the ins and outs of a good conversation. Starting and finishing, staying on topic, switching topics and keeping things going are all covered.";
            $cover_url = "https://www.readings.com.au/system/uploads/assets/0004/5596/4a837f878100add273faad087441142c.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Your Name is a Song";
            $author = "Jamilah Thompkins-Bigelow";
            $topic = "First Day of School";
            $summary = "A young girl learns the musicality of African, Asian, Black-American, Latinx, and Middle Eastern names and returns to school, eager to share with her classmates.";
            $cover_url = "https://s18670.pcdn.co/wp-content/uploads/61GrDag3PGL-800x808.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Our Class is a Family";
            $author = "Shannon Olsen";
            $topic = "First Day of School";
            $summary = "Show your class that they are a family, no matter whether they meet for online or in-person learning.";
            $cover_url = "https://s18670.pcdn.co/wp-content/uploads/71aLultW5EL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Last Stop on Market Street";
            $author = "Matt de la Pena";
            $topic = "Poverty";
            $summary = "A boy and his grandma catch the bus. We don’t yet know where they are headed, but along the way the boy asks questions about why they don’t have certain luxuries. He wants to know why they don’t have a car or an ipod. The grandma has a ready answer about the advantages of what they do have and encourages him to think of positive aspects of lacking material goods. When they reach their destination we find out that they were traveling to help out at a soup kitchen.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/91z5OmJdesL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "A Chair for My Mother";
            $author = "Vera B. Williams";
            $topic = "Poverty";
            $summary = "The narrator, a young girl, describes how her family lost everything in a fire. They found a new home, and their neighbors donated furniture, but what they lacked was a comfortable chair for her mother to rest in after her days of work as a waitress. The family saves their change in a jar and when the coins finally reach the top, they set off to buy the perfect chair. The touching story shares a valuable lesson not just about perseverance and love, but about recognizing that for many families, having a good chair is a luxury.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/61zkWYota9L.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Rocky Road";
            $author = "Rose Kent";
            $topic = "Single Parents";
            $summary = "Tess Dobson is moving to Schenectady, New York, another one of her hair-brained ideas by her bipolar single mother. Her younger brother is hearing impaired so that leaves just her to keep the family together. When her mother’s dream of owning an ice cream parlor goes south, can she pull together her new friends, both young and old — they are living in a retirement village — to save the business? ";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/71i5IPPZZOL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Yoko";
            $author = "Rosemary Wells";
            $topic = "Single Parents";
            $summary = "Yoko’s family is quite small. It’s just she and her mother. She has grandparents back in Japan who love her but that’s a different story (Yoko’s Paper Cranes). When Yoko brings sushi for her school lunch, she is embarrassed by her “weird lunch.”  Her teacher devises an international food day to teach kids tolerance. Will it work?  This is a wonderful multicultural picture book that covers themes of bullying and friendship.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/61PJiUmDz1L._SX258_BO1,204,203,200_.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Danbi Leads the School Parade";
            $author = "Anna Kim";
            $topic = "Immigrant Experience";
            $summary = "On her first day at her new American school, Danbi has trouble understanding her teacher’s instructions and her classmates’ games. But over lunch, Danbi finds a way to meld her two cultures and create a new game, one everyone can play. An uplifting picture book about finding connection through, not despite, our differences.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/81ByGq6AIAL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "We Came to America";
            $author = "Faith Ringgold";
            $topic = "Immigrant Experience";
            $summary = "We Came to America is a poetic ode to the inherent diversity of the U.S. and an exploration of the many reasons our ancestors immigrated here — willingly and unwillingly, toward hope or away from fear — and the cultural traditions and talents they brought to the melting pot. It’s an essential reminder that, with the exception of Native Americans, whose land we live on, we are all immigrants here.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/A167qqvazuL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Faraway Friends";
            $author = "Russ Cox";
            $topic = "Friend Moving Away";
            $summary = "When Sheldon’s best friend moves away, he notices the word “Jupiter” on the side of the moving truck. Could it be that his friend is moving to Jupiter? Sheldon just needs a rocket ship to catch up with his friend. Luckily he has all the parts he needs lying around his house and his dog Jet to help him. On his way there, he finds a surprise that makes him miss his friend a lot less.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/71WcIpO2MEL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "My Life in Pictures";
            $author = "Deborah Zemke";
            $topic = "Friend Moving Away";
            $summary = "Bea Garcia is upset because her next-door neighbor and very best friend in the world, Yvonne, has moved to Australia. To add insult to injury, a new family moves into Yvonne’s house, and they have a horrible boy named Bert who makes fun of Bea, wrecks her cardboard box building, and is generally horrible. Bea and her brother Pablo try to ignore Bert as much as possible, but since he is also in her classroom at school, Bea struggles with putting up with him.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/91NL63CKnRL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "My Body Belongs to Me from My Head to My Toes";
            $author = "pro familia";
            $topic = "Abuse";
            $summary = "An informational picture book that provides children with confidence about accepting and rejecting physical contact from others is an invaluable resource that can help give children a voice in uncomfortable situations.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/71jL0hYewbL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "My Quiet Ship";
            $author = "Hallee Adelman";
            $topic = "Abuse";
            $summary = "Whenever the yelling in his house starts, Quinn runs to a special hiding place. There he becomes captain of the Quiet Ship, where he can get far, far away from the yelling that hurts his ears and makes him feel scared. But one day the Quiet Ship is broken and Quinn needs a new plan, one that requires him to be brave. A thoughtful treatment of a difficult topic, this story is for any child who faces fighting in the home.";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/714z9Wm2ahL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Nana Upstairs and Nana Downstairs";
            $author = "Tommy dePaola";
            $topic = "Death and Grief";
            $summary = "a tender story of love and care for an elderly relative through the eyes of a young boy named Tommy. We see Tommy helping his grandmother care for his 94-year-old great-grandmother, and the close bond he shares with both women. When his great-grandmother (and later his grandmother) dies, the story shows Tommy’s reactions to the deaths of these beloved family members.";
            $cover_url = "https://www.scholastic.com/content/dam/parents/migrated-assets/blogs/body-text-images-12/nana-upstairs-and-nana-downstairs-book-cover.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "I Miss You: A First Look at Death";
            $author = "Pat Thomas";
            $topic = "Death and Grief";
            $summary = "I Miss You: A First Look at Death explains what we know about death and grief in a simple, factual manner. It outlines reasons why people die, introduces what a funeral is, and explores the difficult feelings and emotions of saying goodbye and missing someone very much.";
            $cover_url = "https://www.scholastic.com/content/dam/parents/migrated-assets/blogs/body-text-images-12/i-miss-you-book-cover.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Critters Cry Too";
            $author = "Anthony Curcio";
            $topic = "Drugs and Alcohol";
            $summary = "A wonderful allegory for addiction, this book presents addiction and dependency in a way that children can identify with. Although the Critters had been happy with their lives before “whateveritwas,” or “cookies,” came, once they started eating them it was all they wanted. Over the course of the book, Calvin follows advice and talks to loved ones to alleviate his sadness. Although he can’t save all the Critters himself, he learns how to love himself and find himself despite the sadness. ";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/51Xlp0Kty0L.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "An Elephant in the Living Room";
            $author = "Jill M. Hastings";
            $topic = "Drugs and Alcohol";
            $summary = "Often used by healthcare professionals, this book helps children understand and cope with the reality of addiction in their families. A good resource, it helps explain addiction and the psychology behind its impact on childhood development. Because children will copy their family’s behaviors, they learn at a young age that they shouldn’t talk about the “elephant.” Introducing this workbook to them will help them begin talking about hard things in a productive and healthy manner. ";
            $cover_url = "https://images-na.ssl-images-amazon.com/images/I/71IxpKQ9ZhL.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "Zak's Safari";
            $author = "Christy Tyner";
            $topic = "Same-Sex Parents";
            $summary = "Zak tells the reader the story of how his family came to be. He introduces the reader to his moms, shows us how they met and fell in love, and tells us how they wanted to have a baby more than anything. He teaches us about what is needed to make a baby, genes, and where eggs and sperm come from. He teaches us about known-donors and sperm bank donors and touches upon the process. He ends with showing us the adventures that he and his family have, and shows us that his family is just like any other!";
            $cover_url = "https://static.wixstatic.com/media/2a2a20_642359d7c66a4692b981e8d7bcd8f779~mv2.jpg/v1/fill/w_600,h_600,al_c,lg_1,q_90/2a2a20_642359d7c66a4692b981e8d7bcd8f779~mv2.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);

            $title = "The Family Book";
            $author = "Todd Parr";
            $topic = "Same-Sex Parents";
            $summary = "This book teaches children all about the many shapes and sizes that a family can come in, and how they are all equally beautiful and unique. It teaches us the importance of embracing our differences and accepting others for theirs.";
            $cover_url = "https://static.wixstatic.com/media/2a2a20_b4173e6e58e849219cc50b7912187c9a~mv2_d_1500_1500_s_2.jpg/v1/fill/w_1480,h_1480,al_c,q_90,usm_0.66_1.00_0.01/2a2a20_b4173e6e58e849219cc50b7912187c9a~mv2_d_1500_1500_s_2.jpg";
            $is_in_reading_list = "FALSE";
            mysqli_stmt_execute($stmt);
        } else {
            echo "Error preparing $sqlInsert: " . mysqli_error($link);
        }
    }

    // Make an array of the books in the table
    $sql = "SELECT * FROM Book";
    $result = $conn->query($sql);
    $arrayOfBooks = [];
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($arrayOfBooks, [$row["id"], $row["title"], $row["author"], $row["topic"], $row["summary"], $row["cover_url"], $row["is_in_reading_list"]]);
    }
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
?>

<!-- Updating -->
<?php
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = $_GET["id"];

        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "BookFinder";

        // Create connection
        $connUpdate = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sqlUpdate = "UPDATE Book SET is_in_reading_list=TRUE WHERE id=" . $id;

        if ($connUpdate->query($sqlUpdate) === TRUE) { // Record updated successfully
            echo "Reading List successfully updated! Click on the Browse All Books button to refresh the page.";
        } else {
            echo "Error updating the Reading List.";
        }
            
        // Close the connection
        $connUpdate->close();
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Finder - Home Page (Browse All Books)</title>
        <link href="styles/home-page-styles.css" rel="stylesheet">
        <script type="text/javascript">var booksInfoPHP =<?php echo json_encode($arrayOfBooks); ?>;</script>
        <script type="text/javascript" src="scripts/home-page-script.js"></script>
    </head>

    <body>
        <!-- Header -->
        <div id="header">
            <!--Navigation buttons on the left-->
            <div id="header-left">
                <button id="browse-all-books-button" class="header-button">Browse All Books</button>
                <button id="browse-all-topics-button" class="header-button">Browse All Topics</button>
                <button id="reading-list-button" class="header-button">Reading List</button>
            </div>
            <!--Search functionality on the right-->
            <div id="header-right">
                <span id="header-text">Search By Title or Author</span>
                <input type="text" id="header-search-bar" placeholder="Search here...">
                <button id="search-button" class="header-button">Search!</button>
            </div>
        </div>

        <!-- Main Page -->
        <div id="main">
            <!--Title text-->
            <div id="title-text">Welcome to Book Finder!</div>
            <div id="title-subtext">Double click on a book to see its overview... or add it to your Reading List!</div>

            <!--Books (will be populated later)-->
            <div id="books"></div>
            <div id="more-info-modal">
                <div id="mofe-info-modal-content">
                    <span id="close-button">&times;</span>
                    <img id="more-info-cover" class="book-cover">
                    <p id="more-info-title" class="more-info-text"></p>
                    <p id="more-info-author" class="more-info-text"></p>
                    <p id="more-info-topic" class="more-info-text"></p>
                    <p id="more-info-summary" class="more-info-text"></p>
                </div>
            </div>
        </div>
    </body>
</html>