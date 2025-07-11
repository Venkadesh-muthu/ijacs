<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\VolumeModel;
use App\Models\IssueModel;
use App\Models\ArticleModel;
use App\Models\ReferenceModel;

class AdminController extends BaseController
{
    protected $adminModel;
    protected $volumeModel;
    protected $issueModel;
    protected $articleModel;
    protected $referenceModel;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->adminModel = new AdminModel();
        $this->volumeModel = new VolumeModel();
        $this->issueModel = new IssueModel();
        $this->articleModel = new ArticleModel();
        $this->referenceModel = new ReferenceModel();
    }

    public function index()
    {
        return view('admin/login');
    }

    public function login()
    {
        helper(['form']);

        $session = session();

        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->adminModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set('isAdminLoggedIn', true);
            $session->set('admin_id', $user['id']);
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid username or password');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin');
    }

    public function dashboard()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin');
        }

        // Count total distinct years from volumes
        $totalYears = $this->volumeModel
            ->select('year')
            ->groupBy('year')
            ->countAllResults();

        // Fetch latest 5 issues with volume details
        $recentIssues = $this->issueModel
            ->select('issues.*, volumes.volume_no, volumes.year')
            ->join('volumes', 'volumes.id = issues.volume_id')
            ->orderBy('issues.published_date', 'DESC')
            ->limit(5)
            ->find();

        // Optionally fetch one article PDF per issue (first one)
        foreach ($recentIssues as &$issue) {
            $article = $this->articleModel
                ->where('issue_id', $issue['id'])
                ->orderBy('id', 'ASC') // Or DESC for latest
                ->first();

            $issue['pdf_file'] = $article['pdf_file'] ?? null;
        }

        $data = [
            'title' => 'Dashboard',
            'name' => session()->get('admin_name'),
            'total_years' => $totalYears,
            'total_volumes' => $this->volumeModel->countAllResults(),
            'total_issues' => $this->issueModel->countAllResults(),
            'total_articles' => $this->articleModel->countAllResults(),
            'recent_issues' => $recentIssues,
            'content' => 'admin/dashboard',
        ];

        return view('admin/layout/templates', $data);
    }


    // -------------------- VOLUMES --------------------
    public function volumes()
    {
        $this->checkLogin();

        $perPage = 10; // Change as needed
        $volumes = $this->volumeModel->orderBy('created_at', 'DESC')->paginate($perPage, 'default');

        $data = [
            'title' => 'Volumes',
            'volumes' => $volumes,
            'pager' => $this->volumeModel->pager,
            'content' => 'admin/volumes'
        ];
        return view('admin/layout/templates', $data);
    }


    public function addVolume()
    {
        $this->checkLogin();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'year' => 'required',
                'volume_no' => 'required'
            ];

            if (!$this->validate($rules)) {
                return view('admin/layout/templates', [
                    'title' => 'Add Volume',
                    'content' => 'admin/add_volume',
                    'validation' => $this->validator
                ]);
            }

            // Save volume if validation passes
            $this->volumeModel->save([
                'year' => $this->request->getPost('year'),
                'volume_no' => $this->request->getPost('volume_no')
            ]);

            return redirect()->to('/admin/volumes')->with('success', 'Volume added successfully.');
        }

        return view('admin/layout/templates', [
            'title' => 'Add Volume',
            'content' => 'admin/add_volume'
        ]);
    }

    public function editVolume($id)
    {
        $this->checkLogin();

        // Fetch the existing volume
        $volume = $this->volumeModel->find($id);

        // If not found, redirect with error
        if (!$volume) {
            return redirect()->to('/admin/volumes')->with('error', 'Volume not found.');
        }

        // Handle form submission
        if ($this->request->getMethod() === 'POST') {
            $this->volumeModel->update($id, [
                'year' => $this->request->getPost('year'),
                'volume_no' => $this->request->getPost('volume_no')
            ]);
            return redirect()->to('/admin/volumes')->with('success', 'Volume updated successfully.');
        }

        // Load the edit view
        $data = [
            'title' => 'Edit Volume',
            'volume' => $volume,
            'content' => 'admin/edit_volume'
        ];
        return view('admin/layout/templates', $data);
    }
    public function deleteVolume($id)
    {
        $this->checkLogin();

        // Check if the volume exists
        $volume = $this->volumeModel->find($id);
        if (!$volume) {
            return redirect()->to('/admin/volumes')->with('error', 'Volume not found.');
        }

        // Delete the volume
        $this->volumeModel->delete($id);

        return redirect()->to('/admin/volumes')->with('success', 'Volume deleted successfully.');
    }

    // -------------------- ISSUES --------------------
    public function issues()
    {
        $this->checkLogin();

        $perPage = 10; // Number of issues per page

        $issues = $this->issueModel
            ->select('issues.*, volumes.volume_no, volumes.year')
            ->join('volumes', 'volumes.id = issues.volume_id')
            ->orderBy('issues.created_at', 'DESC')
            ->paginate($perPage, 'default');

        $data = [
            'title' => 'Issues',
            'issues' => $issues,
            'pager' => $this->issueModel->pager, // Include pager object
            'content' => 'admin/issues'
        ];

        return view('admin/layout/templates', $data);
    }


    public function addIssue()
    {
        $this->checkLogin();

        if ($this->request->getMethod() === 'POST') {
            $file = $this->request->getFile('issue_image');
            $imageName = null;

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move('uploads/issues', $imageName);
            }

            $this->issueModel->save([
                'volume_id' => $this->request->getPost('volume_id'),
                'issue_no' => $this->request->getPost('issue_no'),
                'published_date' => $this->request->getPost('published_date'),
                'issue_type' => $this->request->getPost('issue_type'),
                'issue_image' => $imageName
            ]);

            return redirect()->to('/admin/issues')->with('success', 'Issue added successfully.');
        }

        $data = [
            'title' => 'Add Issue',
            'volumes' => $this->volumeModel->findAll(),
            'content' => 'admin/add_issue'
        ];
        return view('admin/layout/templates', $data);
    }

    public function editIssue($id)
    {
        $this->checkLogin();
        $issue = $this->issueModel->find($id);

        if (!$issue) {
            return redirect()->to('/admin/issues')->with('error', 'Issue not found.');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'volume_id' => 'required',
                'issue_no' => 'required',
                'published_date' => 'required',
            ];

            if (!$this->validate($rules)) {
                return view('admin/layout/templates', [
                    'title' => 'Edit Issue',
                    'issue' => $issue,
                    'volumes' => $this->volumeModel->findAll(),
                    'content' => 'admin/edit_issue',
                    'validation' => $this->validator
                ]);
            }

            $file = $this->request->getFile('issue_image');
            $imageName = $issue['issue_image']; // keep old image by default

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move('uploads/issues', $imageName);
            }

            $this->issueModel->update($id, [
                'volume_id' => $this->request->getPost('volume_id'),
                'issue_no' => $this->request->getPost('issue_no'),
                'published_date' => $this->request->getPost('published_date'),
                'issue_type' => $this->request->getPost('issue_type'),
                'issue_image' => $imageName
            ]);

            return redirect()->to('/admin/issues')->with('success', 'Issue updated successfully.');
        }

        return view('admin/layout/templates', [
            'title' => 'Edit Issue',
            'issue' => $issue,
            'volumes' => $this->volumeModel->findAll(),
            'content' => 'admin/edit_issue'
        ]);
    }

    public function deleteIssue($id)
    {
        $this->checkLogin();

        $issue = $this->issueModel->find($id);
        if (!$issue) {
            return redirect()->to('/admin/issues')->with('error', 'Issue not found.');
        }

        $this->issueModel->delete($id);
        return redirect()->to('/admin/issues')->with('success', 'Issue deleted successfully.');
    }

    // -------------------- ARTICLES --------------------
// Show all articles
    public function articles()
    {
        $this->checkLogin();

        $perPage = 10; // Number of articles per page

        $data = [
            'title' => 'Articles',
            'articles' => $this->articleModel->orderBy('created_at', 'DESC')->paginate($perPage),
            'pager' => $this->articleModel->pager, // Pass the pager object to the view
            'content' => 'admin/articles'
        ];

        return view('admin/layout/templates', $data);
    }


    // Add Article
    public function addArticle()
    {
        $this->checkLogin();

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'title' => 'required',
                'authors' => 'required',
                'issue_id' => 'required'
            ];

            if (!$this->validate($rules)) {
                return view('admin/layout/templates', [
                    'title' => 'Add Article',
                    'issues' => $this->issueModel->findAll(),
                    'validation' => $this->validator,
                    'content' => 'admin/add_article'
                ]);
            }

            $pdf = $this->request->getFile('pdf_file');
            $pdfName = $pdf && $pdf->isValid() ? $pdf->getRandomName() : null;
            if ($pdfName)
                $pdf->move('uploads/articles/', $pdfName);

            $imageName = null;
            $imageFile = $this->request->getFile('image');

            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                $imageName = $imageFile->getRandomName();
                $imageFile->move(FCPATH . 'uploads/images', $imageName);
            }

            $this->articleModel->save([
                'issue_id' => $this->request->getPost('issue_id'),
                'title' => $this->request->getPost('title'),
                'subtitle' => $this->request->getPost('subtitle'),
                'authors' => $this->request->getPost('authors'),
                'doi' => $this->request->getPost('doi'),
                'pages' => $this->request->getPost('pages'),
                'abstract' => $this->request->getPost('abstract'),
                'keywords' => $this->request->getPost('keywords'),
                'image' => $imageName,
                'pdf_file' => $pdfName,
            ]);

            return redirect()->to('/admin/articles')->with('success', 'Article added successfully.');
        }

        $issuesWithVolume = $this->issueModel
            ->select('issues.*, volumes.volume_no, volumes.year')
            ->join('volumes', 'volumes.id = issues.volume_id')
            ->orderBy('volumes.year', 'DESC')
            ->orderBy('issues.issue_no', 'ASC')
            ->findAll();

        return view('admin/layout/templates', [
            'title' => 'Add Article',
            'issuesWithVolume' => $issuesWithVolume,
            'content' => 'admin/add_article'
        ]);

    }

    // Edit Article
    public function editArticle($id)
    {
        $this->checkLogin();
        $article = $this->articleModel->find($id);

        if (!$article) {
            return redirect()->to('/admin/articles')->with('error', 'Article not found.');
        }

        if ($this->request->getMethod() === 'POST') {
            $pdf = $this->request->getFile('pdf_file');
            $pdfName = ($pdf && $pdf->isValid()) ? $pdf->getRandomName() : $article['pdf_file'];
            if ($pdf && $pdf->isValid()) {
                $pdf->move(FCPATH . 'uploads/articles', $pdfName);
            }

            $imageName = $article['image']; // Retain current image if not re-uploaded
            $imageFile = $this->request->getFile('image');
            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                $imageName = $imageFile->getRandomName();
                $imageFile->move(FCPATH . 'uploads/images', $imageName);
            }

            $this->articleModel->update($id, [
                'issue_id' => $this->request->getPost('issue_id'),
                'title' => $this->request->getPost('title'),
                'subtitle' => $this->request->getPost('subtitle'),
                'authors' => $this->request->getPost('authors'),
                'doi' => $this->request->getPost('doi'),
                'pages' => $this->request->getPost('pages'),
                'abstract' => $this->request->getPost('abstract'),
                'keywords' => $this->request->getPost('keywords'),
                'image' => $imageName,
                'pdf_file' => $pdfName
            ]);

            return redirect()->to('/admin/articles')->with('success', 'Article updated successfully.');
        }

        $issuesWithVolume = $this->issueModel
            ->select('issues.*, volumes.volume_no, volumes.year')
            ->join('volumes', 'volumes.id = issues.volume_id')
            ->orderBy('issues.published_date', 'DESC')
            ->findAll();

        return view('admin/layout/templates', [
            'title' => 'Edit Article',
            'article' => $article,
            'issuesWithVolume' => $issuesWithVolume,
            'content' => 'admin/edit_article'
        ]);
    }


    // Delete Article
    public function deleteArticle($id)
    {
        $this->checkLogin();
        $article = $this->articleModel->find($id);

        if ($article) {
            // Optionally delete files
            if (!empty($article['pdf_file']) && file_exists('uploads/articles/' . $article['pdf_file'])) {
                unlink('uploads/articles/' . $article['pdf_file']);
            }
            if (!empty($article['images']) && file_exists('uploads/images/' . $article['images'])) {
                unlink('uploads/images/' . $article['images']);
            }
        }

        $this->articleModel->delete($id);
        return redirect()->to('/admin/articles')->with('success', 'Article deleted successfully.');
    }
    public function addReference()
    {
        $this->checkLogin();

        // Load ArticleModel to get articles for dropdown
        $articleModel = new \App\Models\ArticleModel();
        $articles = $articleModel->orderBy('title', 'ASC')->findAll();

        // If form is submitted
        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();

            // Basic validation
            $rules = [
                'ref_no' => 'required|numeric',
                'authors' => 'required|string',
                'title' => 'required|string',
                'source' => 'required|string',
                'year' => 'required|numeric',
                'type' => 'required|string',
                'article_id' => 'permit_empty|numeric'
            ];

            if (!$this->validate($rules)) {
                return view('admin/layout/templates', [
                    'title' => 'Add Reference',
                    'content' => 'admin/add_reference',
                    'articles' => $articles,
                    'validation' => $this->validator
                ]);
            }

            // Prepare data for insert
            $insertData = [
                'article_id' => $data['article_id'] ?? null,  // Optional
                'ref_no' => $data['ref_no'],
                'authors' => $data['authors'],
                'title' => $data['title'],
                'source' => $data['source'],
                'year' => $data['year'],
                'type' => $data['type']
            ];

            // Insert into database
            if ($this->referenceModel->insert($insertData)) {
                return redirect()->to('/admin/references')->with('success', 'Reference added successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to add reference. Please try again.');
            }
        }

        // On GET request, show the form
        return view('admin/layout/templates', [
            'title' => 'Add Reference',
            'content' => 'admin/add_reference',
            'articles' => $articles
        ]);
    }



    public function listReferences()
    {
        $this->checkLogin();

        // Use pagination and assign pager
        $references = $this->referenceModel
            ->orderBy('ref_no', 'ASC')
            ->paginate(10); // Display 10 references per page

        return view('admin/layout/templates', [
            'title' => 'All References',
            'content' => 'admin/list_references',
            'references' => $references,
            'pager' => $this->referenceModel->pager // ✅ pass pager here
        ]);
    }



    public function editReference($id)
    {
        $this->checkLogin();

        // Fetch the reference
        $reference = $this->referenceModel->find($id);
        if (!$reference) {
            return redirect()->to('/admin/references')->with('error', 'Reference not found.');
        }

        // Fetch all articles for the dropdown
        $articleModel = new \App\Models\ArticleModel();
        $articles = $articleModel->orderBy('title')->findAll();

        if ($this->request->getMethod() === 'POST') {
            // Validation rules
            $rules = [
                'ref_no' => 'required|numeric',
                'authors' => 'required',
                'title' => 'required',
                'source' => 'required',
                'year' => 'required|numeric',
                'type' => 'required|regex_match[/^(journal|book)$/]'
            ];


            if (!$this->validate($rules)) {
                return view('admin/layout/templates', [
                    'title' => 'Edit Reference',
                    'content' => 'admin/edit_reference',
                    'reference' => $reference,
                    'articles' => $articles,
                    'validation' => $this->validator
                ]);
            }

            // Update reference
            $this->referenceModel->update($id, [
                'ref_no' => $this->request->getPost('ref_no'),
                'authors' => $this->request->getPost('authors'),
                'title' => $this->request->getPost('title'),
                'source' => $this->request->getPost('source'),
                'publisher' => $this->request->getPost('publisher'),
                'publisher_loc' => $this->request->getPost('publisher_loc'),
                'year' => $this->request->getPost('year'),
                'volume' => $this->request->getPost('volume'),
                'issue' => $this->request->getPost('issue'),
                'pages' => $this->request->getPost('pages'),
                'doi' => $this->request->getPost('doi'),
                'type' => $this->request->getPost('type'),
                'article_id' => $this->request->getPost('article_id') // optional
            ]);

            return redirect()->to('/admin/references')->with('success', 'Reference updated successfully.');
        }

        // Initial GET request
        return view('admin/layout/templates', [
            'title' => 'Edit Reference',
            'content' => 'admin/edit_reference',
            'reference' => $reference,
            'articles' => $articles
        ]);
    }


    public function deleteReference($id)
    {
        $this->checkLogin();

        $reference = $this->referenceModel->find($id);
        if (!$reference) {
            return redirect()->back()->with('error', 'Reference not found.');
        }

        $this->referenceModel->delete($id);
        return redirect()->to('/admin/references')->with('success', 'Reference deleted successfully.');

    }
    public function uploadArticleXmlForm()
    {
        $data = [
            'title' => 'Upload Article XML',
            'content' => 'admin/upload_article_xml' // This should be the name of your form view file
        ];

        return view('admin/layout/templates', $data);
    }


    public function uploadArticleXml()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'POST') {
            $file = $this->request->getFile('xml_file');

            if (!$file || !$file->isValid() || $file->hasMoved()) {
                return redirect()->back()->with('error', 'Uploaded file is invalid or already moved.');
            }

            libxml_use_internal_errors(true);
            $xmlContent = file_get_contents($file->getTempName());
            $xml = simplexml_load_string($xmlContent);

            if (!$xml) {
                $errors = libxml_get_errors();
                libxml_clear_errors();
                return redirect()->back()->with('error', 'Invalid XML format: ' . ($errors[0]->message ?? 'Unknown error'));
            }

            try {
                $articleMeta = $xml->front->{'article-meta'};

                $title = (string) ($articleMeta->{'title-group'}->{'article-title'} ?? '');
                $doi = (string) ($articleMeta->{'article-id'}[1] ?? $articleMeta->{'article-id'} ?? '');
                $volumeNo = (string) ($articleMeta->volume ?? '');
                $issueNo = (string) ($articleMeta->issue ?? '');
                $fpage = (string) ($articleMeta->fpage ?? '');
                $lpage = (string) ($articleMeta->lpage ?? '');
                $pages = $fpage . ($lpage ? '-' . $lpage : '');
                $publishedYear = (string) ($articleMeta->{'pub-date'}->year ?? '');
                $abstract = (string) ($articleMeta->abstract->p ?? '');
                $subtitle = '';
                $pdf_file = '';
                $image = '';

                // Keywords
                $keywords = [];
                if (isset($articleMeta->{'kwd-group'})) {
                    foreach ($articleMeta->{'kwd-group'}->kwd as $kwd) {
                        $keywords[] = (string) $kwd;
                    }
                }
                $keywordStr = implode(', ', $keywords);

                // Authors
                $authors = [];
                if (isset($articleMeta->{'contrib-group'})) {
                    foreach ($articleMeta->{'contrib-group'}->contrib as $contrib) {
                        $name = $contrib->name;
                        $given = isset($name->{'given-names'}) ? (string) $name->{'given-names'} : '';
                        $surname = isset($name->surname) ? (string) $name->surname : '';
                        $authors[] = trim($given . ' ' . $surname);
                    }
                }
                $authorsStr = implode(', ', $authors);

                if (!$title || !$volumeNo || !$issueNo || !$publishedYear) {
                    return redirect()->back()->with('error', 'Missing essential metadata in XML.');
                }

                // ===== Insert Volume =====
                $volumeModel = new \App\Models\VolumeModel();
                $volume = $volumeModel->where(['year' => $publishedYear, 'volume_no' => $volumeNo])->first();
                $volumeId = $volume ? $volume['id'] : $volumeModel->insert([
                    'year' => $publishedYear,
                    'volume_no' => $volumeNo,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                // ===== Insert Issue =====
                $issueModel = new \App\Models\IssueModel();
                $issue = $issueModel->where(['volume_id' => $volumeId, 'issue_no' => $issueNo])->first();
                $issueId = $issue ? $issue['id'] : $issueModel->insert([
                    'volume_id' => $volumeId,
                    'issue_no' => $issueNo,
                    'published_date' => $publishedYear . '-01-01',
                    'issue_type' => 'Regular',
                    'issue_image' => '',
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                // ===== Insert Article =====
                $articleModel = new \App\Models\ArticleModel();
                $articleId = $articleModel->insert([
                    'issue_id' => $issueId,
                    'title' => $title,
                    'subtitle' => $subtitle,
                    'authors' => $authorsStr,
                    'doi' => $doi,
                    'pages' => $pages,
                    'abstract' => $abstract,
                    'keywords' => $keywordStr,
                    'pdf_file' => $pdf_file,
                    'image' => $image
                ]);

                // ===== Insert References =====
                $referenceModel = new \App\Models\ReferenceModel();
                $refList = $xml->back->{'ref-list'} ?? null;

                if ($refList && $refList->ref) {
                    $refNo = 1;
                    foreach ($refList->ref as $ref) {
                        $citation = $ref->{'nlm-citation'};
                        $authors = [];

                        if (isset($citation->{'person-group'})) {
                            foreach ($citation->{'person-group'}->name as $author) {
                                $given = (string) ($author->{'given-names'} ?? '');
                                $surname = (string) ($author->surname ?? '');
                                $authors[] = trim($given . ' ' . $surname);
                            }
                        }

                        $refData = [
                            'article_id' => $articleId,
                            'ref_no' => $refNo++,
                            'authors' => implode(', ', $authors),
                            'title' => (string) ($citation->{'article-title'} ?? ''),
                            'source' => (string) ($citation->source ?? ''),
                            'publisher' => (string) ($citation->{'publisher-name'} ?? ''),
                            'publisher_loc' => (string) ($citation->{'publisher-loc'} ?? ''),
                            'year' => (string) ($citation->year ?? ''),
                            'volume' => (string) ($citation->volume ?? ''),
                            'issue' => (string) ($citation->issue ?? ''),
                            'pages' => (string) ($citation->fpage ?? '') . '-' . (string) ($citation->lpage ?? ''),
                            'doi' => (string) ($citation->doi ?? ''),
                            'type' => (string) ($citation['citation-type'] ?? '')
                        ];

                        $referenceModel->insert($refData);
                    }
                }

                return redirect()->back()->with('success', 'Article and references imported successfully. ID: ' . $articleId);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error processing XML: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'Please upload a valid XML file.');
    }

    public function uploadReferences()
    {
        helper(['form', 'filesystem']);

        $file = $this->request->getFile('xml_file');

        if (!$file || !$file->isValid() || $file->getClientExtension() !== 'xml') {
            return redirect()->back()->with('error', 'Please upload a valid XML file.');
        }

        $xmlContent = file_get_contents($file->getTempName());
        $xml = simplexml_load_string($xmlContent);

        if (!$xml) {
            return redirect()->back()->with('error', 'Failed to parse XML file.');
        }

        $referenceModel = new ReferenceModel();

        // You can dynamically set article_id if needed, hardcoded for now
        $articleId = 1;
        $count = 0;

        foreach ($xml->ref as $ref) {
            $citation = $ref->{'nlm-citation'};
            $authors = [];

            if (isset($citation->{'person-group'}->{'name'})) {
                foreach ($citation->{'person-group'}->{'name'} as $author) {
                    $given = (string) $author->{'given-names'};
                    $surname = (string) $author->surname;
                    $authors[] = trim("$given $surname");
                }
            }

            $authorsStr = implode(', ', $authors);

            $referenceData = [
                'article_id' => $articleId,
                'ref_no' => (int) $ref->label,
                'authors' => $authorsStr,
                'title' => (string) $citation->{'article-title'},
                'source' => (string) $citation->source,
                'publisher' => (string) $citation->{'publisher-name'},
                'publisher_loc' => (string) $citation->{'publisher-loc'},
                'year' => (string) $citation->year,
                'volume' => (string) $citation->volume,
                'issue' => (string) $citation->issue,
                'pages' => $this->extractPages($citation),
                'doi' => (string) $citation->doi,
                'type' => (string) $citation['citation-type'],
                'created_at' => date('Y-m-d H:i:s')
            ];

            $referenceModel->insert($referenceData);
            $count++;
        }

        return redirect()->back()->with('success', "$count references uploaded successfully.");
    }

    private function extractPages($citation)
    {
        $fpage = (string) $citation->fpage;
        $lpage = (string) $citation->lpage;

        if ($fpage && $lpage) {
            return "$fpage-$lpage";
        }

        return $fpage ?: null;
    }

    // -------------------- Helper --------------------
    private function checkLogin()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin')->send();
        }
    }
}
