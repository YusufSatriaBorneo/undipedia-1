<?php include('header.html') ?>
<?php include('navbar.php') ?>
<br>        <br>        <br>        <br>
<section>
    <div class="container">
         <div class="half-post-entry d-block d-lg-flex bg-light">
          <div class="contents">
            <?php
                require_once('db_login.php');
                 $id = (isset($_POST['id']) ? $_POST['id'] : '');
                 $query = " SELECT post.judul AS judul, penulis.nama AS nama, post.file_gambar AS file_gambar, post.isipost AS isi_post, post.idpenulis AS idpenulis FROM post JOIN penulis ON post.idpenulis = penulis.idpenulis WHERE post.idpost = '".$id."' "; 
                $result = $db->query($query);
                    if (!$result){
                        die("Could not query the database: <br>".$db->error."<br>Query: ".$query);
                    }
                    while ($row = $result->fetch_object()){
                            $idpenulis = $row->idpenulis;
                             print_r('<div class="shadow-lg p-3 mb-5 bg-white rounded" id="shadow">');
                             echo'<h1 id="judul">'.$row->judul.'</h1>';
                             echo'<h5 id="nama">'.$row->nama.'</h5>';
                             echo'<img src="data:images/jpg;base64,'.base64_encode($row->file_gambar).'" id="file_gambar">';
                             echo'<p id="isi">'.$row->isi_post.'</p>';
                             echo'</div>';
                        }
            ?>
          </div>
      </div>
    </div>
    
</section>
        <br>        <br>       
    <div class="container">
        <footer class="page-footer" id="comment">
        <form method="POST" autocomplete="on" action="simpan.php?id=<?php echo $id; ?>&penulis=<?php echo $idpenulis; ?>">
                <div class="form-group">
                    <label for="comment">Leave a Comment:</label>
                    <input type="text" class="form-control" name="comment" value="">
                </div>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
        </form>
        <br>
        <div class="container">
            <h2>Comments</h2>
            <br> 
            
        <?php
        require_once('db_login.php');
        $query = " SELECT komentar.isi AS isi FROM komentar JOIN post ON komentar.idpost = post.idpost WHERE post.idpost = '".$id."' "; 
        $result = $db->query($query);
        if (!$result){
            die ("Could not query the database: <br />". $db->error."<br>Query: ".$query);
        }
        while ($row = $result->fetch_object()){
        echo'
                <div class="media">
                <div class="media-body">
                <p>'.$row->isi.'</p>
                </div>
            </div>
            <hr>';
        }
        ?>
        </div>
    </footer>
    </div>
<?php include('footer.html') ?>
