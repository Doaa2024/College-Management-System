<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php');

// Create an instance of the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve userID from GET, with a default value of 3 if not provided
$userID = isset($_GET['userID']) ? intval($_GET['userID']) : 3;
$userInfo = $universityData->getUserInfo($userID);

?>
<div class="container my-5  shadow-lg px-5" style="min-height:70dvh">
    <!-- Page Title -->
    <div class="text-center mb-4 pt-2">
        <h1 class="display-4">Manage Your Requests</h1>
    </div>
    <style>
        .folderContainer {
            width: 150px;
            height: fit-content;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            position: relative;
            margin-left: 27%;
            margin-bottom: 4%;
        }

        .fileBack {
            z-index: 1;
            width: 80%;
            height: auto;
        }

        .filePage {
            width: 50%;
            height: auto;
            position: absolute;
            z-index: 2;
            transition: all 0.3s ease-out;
        }

        .fileFront {
            width: 85%;
            height: auto;
            position: absolute;
            z-index: 3;
            opacity: 0.95;
            transform-origin: bottom;
            transition: all 0.3s ease-out;
        }

        .text {
            color: white;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .Documents-btn:hover .filePage {
            transform: translateY(-5px);
        }

        .Documents-btn:hover {
            background-color: rgb(58, 58, 94);
        }

        .Documents-btn:active {
            transform: scale(0.95);
        }

        .Documents-btn:hover .fileFront {
            transform: rotateX(30deg);
        }

        .fst,
        .scd {
            border: 1px solid purple
        }

        .fst {
            font: white !important;
            background-color: purple;
        }

        .fst:hover {
            font: purple !important;
            background-color: none;
        }

        .scd:hover {
            font: white !important;
            background-color: purple;
        }
    </style>
    <!-- Options Section -->
    <div class="row">
        <!-- Petition Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-primary shadow-sm" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
                <div class="card-body text-center">
                    <svg width="100" height="100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M18.18 8.03933L18.6435 7.57589C19.4113 6.80804 20.6563 6.80804 21.4241 7.57589C22.192 8.34374 22.192 9.58868 21.4241 10.3565L20.9607 10.82M18.18 8.03933C18.18 8.03933 18.238 9.02414 19.1069 9.89309C19.9759 10.762 20.9607 10.82 20.9607 10.82M18.18 8.03933L13.9194 12.2999C13.6308 12.5885 13.4865 12.7328 13.3624 12.8919C13.2161 13.0796 13.0906 13.2827 12.9882 13.4975C12.9014 13.6797 12.8368 13.8732 12.7078 14.2604L12.2946 15.5L12.1609 15.901M20.9607 10.82L16.7001 15.0806C16.4115 15.3692 16.2672 15.5135 16.1081 15.6376C15.9204 15.7839 15.7173 15.9094 15.5025 16.0118C15.3203 16.0986 15.1268 16.1632 14.7396 16.2922L13.5 16.7054L13.099 16.8391M13.099 16.8391L12.6979 16.9728C12.5074 17.0363 12.2973 16.9867 12.1553 16.8447C12.0133 16.7027 11.9637 16.4926 12.0272 16.3021L12.1609 15.901M13.099 16.8391L12.1609 15.901" stroke="#003cff" stroke-width="1.5"></path>
                            <path d="M8 13H10.5" stroke="#003cff" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M8 9H14.5" stroke="#003cff" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M8 17H9.5" stroke="#003cff" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M3 14V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157M21 14C21 17.7712 21 19.6569 19.8284 20.8284M4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284M19.8284 20.8284C20.7715 19.8853 20.9554 18.4796 20.9913 16" stroke="#003cff" stroke-width="1.5" stroke-linecap="round"></path>
                        </g>
                    </svg>
                    <h5 class="card-title">Petitions</h5>
                    <p class="card-text">Manage your Petitions here.</p>
                    <a href="showRequests.php?userID=<?= $userID ?>&FacID=<?= $userInfo[0]['FacultyID'] ?>" class="btn btn-primary btn-block">Track Submitted</a>
                    <a data-toggle="modal" data-target="#petitionModal" class="btn btn-outline-primary btn-block">Submit New</a>
                </div>
            </div>
        </div>

        <!-- Financial Aids Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-success shadow-sm" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
                <div class="card-body text-center">
                    <svg width="100" height="100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 58" class="image">
                        <g fill-rule="evenodd" fill="none" id="Page-1">
                            <g fill-rule="nonzero" id="059---Money-Bag">
                                <path fill="#f29c1f" d="m23 16.98v-9.98c0-1.66-2.91-3-6.5-3s-6.5 1.34-6.5 3v11.01c-3.36.12-6 1.41-6 2.99v26.23c-2.35.45-4 1.52-4 2.77v5c0 1.66 2.91 3 6.5 3s6.5-1.34 6.5-3v-2c0 1.66 2.91 3 6.5 3s6.5-1.34 6.5-3l.5-13z" id="Shape"></path>
                                <path fill="#f3d55b" d="m54.527 13.355c-.072-.108-1.461-2.092-5.5-3 1.0331933-.84954961 1.6441867-2.10769199 1.673-3.445 0-2.358-2.006-4.417-4.769-4.895-.5372791-.08053169-1.0405693.28263221-1.1334952.81790692s.2585108 1.04682267.7914952 1.15209308c1.798.315 3.111 1.542 3.111 2.925 0 1.638-1.775 2.984-4 3-.8755119.01021562-1.7370699-.21978683-2.491-.665-.4719273-.28691192-1.0870881-.13692731-1.374.33500001-.2869119.47192729-.1369273 1.08708809.335 1.37399999 1.0594655.6270481 2.2688888.9556657 3.5.951.01 0 .017.005.026.005 6.213 0 8.124 2.5 8.176 2.567.200426.2958159.5434432.4622351.8998403.436569.356397-.025666.6720289-.239518.828-.561.155971-.3214819.1285857-.7017531-.0718403-.997569z" id="Shape"></path>
                                <path fill="#a56a43" d="m45.19 52h-19.19v-12c0-1.66-2.91-3-6.5-3-.8387701-.0034358-1.6759363.0735835-2.5.23v-10.89c1.4565382-3.4367258 3.4852949-6.6015863 6-9.36v-.01c2.0874104-2.3329398 4.5726948-4.2764728 7.34-5.74v-.01c.8551132.5204315 1.8390235.7906603 2.84.78h5.6c1.0050057.0070139 1.9920265-.2665813 2.85-.79 2.18 1.08 12.01 6.72 15.56 21.79 4 17-8 19-12 19z" id="Shape"></path>
                                <path fill="#fdd7ad" d="m45.19 49c-.5522847 0-1-.4477153-1-1s.4477153-1 1-1c.723 0 4.425-.125 6.376-2.589.9225786-1.3035875 1.4145252-2.8629918 1.407-4.46.0332885-.5485091.4978261-.970453 1.047-.951.2649656.0126906.5140321.1301392.6923876.326499.1783554.1963597.2713838.4555393.2586124.720501-.0084762 2.0150456-.6508108 3.9763353-1.836 5.606-2.524 3.186-7.061 3.347-7.945 3.347z" id="Shape"></path>
                                <path fill="#805333" d="m46 1.17c.01 2.2-.43 7-3.95 9.75-.1318612.1079533-.2723293.2049432-.42.29-.8579735.5234187-1.8449943.7970139-2.85.79h-5.6c-1.0009765.0106603-1.9848868-.2595685-2.84-.78-.1495192-.0908277-.2931396-.191028-.43-.3-3.52-2.75-3.95-7.55-3.95-9.75.0016568-.33258473.1685567-.6425818.4452874-.8270689.2767306-.18448711.6270741-.21931899.9347126-.0929311 1.28.54 1.71 1.75 3.65 1.75 2.49 0 2.49-2 4.98-2s2.5 2 5 2c1.94 0 2.37-1.22 3.65-1.75.3076385-.12638789.657982-.09155601.9347126.0929311.2767307.1844871.4436306.49448417.4452874.8270689z" id="Shape"></path>
                                <path fill="#603e26" d="m36.45 11.982c1.164119-1.6359812 2.0400633-3.45889226 2.59-5.39.1491169-.53295478.7020452-.84411688 1.235-.695s.8441169.70204522.695 1.235c-.545409 1.83131833-1.3359015 3.5804932-2.35 5.2l3.34 3.12c.4031679.3783151.423315 1.0118321.045 1.415-.3783151.4031678-1.0118321.423315-1.415.045l-3.59-3.35v3.3c0 .5522847-.4477153 1-1 1s-1-.4477153-1-1v-3.3l-3.58 3.35c-.1844231.1726652-.4273651.2691275-.68.27-.2800466-.0009897-.5474685-.1166316-.74-.32-.3709419-.4048785-.3486888-1.0324134.05-1.41l3.35-3.12c-1.0179074-1.618792-1.8117948-3.36803545-2.36-5.2-.0704836-.2559398-.0363072-.52940237.0949974-.76012341.1313047-.23072105.3489609-.3997642.6050026-.46987659.2546559-.07392838.5283328-.04249768.7595988.08723693.231266.1297346.4007475.34690489.4704012.60276307.5569409 1.93085241 1.4433119 3.7509576 2.62 5.38z" id="Shape"></path>
                                <path fill="#f0c419" d="m17 21c0 1.66-2.91 3-6.5 3s-6.5-1.34-6.5-3c0-1.58 2.64-2.87 6-2.99.17-.01.33-.01.5-.01 3.59 0 6.5 1.34 6.5 3z" id="Shape"></path>
                                <path fill="#e57e25" d="m23 7v9.98c-2.5147051 2.7584137-4.5434618 5.9232742-6 9.36v-5.34c0-1.66-2.91-3-6.5-3-.17 0-.33 0-.5.01v-11.01c0 1.66 2.91 3 6.5 3s6.5-1.34 6.5-3z" id="Shape"></path>
                                <path fill="#f9eab0" d="m13 50c0 1.66-2.91 3-6.5 3s-6.5-1.34-6.5-3c0-1.25 1.65-2.32 4-2.77.82406367-.1564165 1.66122992-.2334358 2.5-.23 3.59 0 6.5 1.34 6.5 3z" id="Shape"></path>
                                <path fill="#f3d55b" d="m13 50v5c0 1.66-2.91 3-6.5 3s-6.5-1.34-6.5-3v-5c0 1.66 2.91 3 6.5 3s6.5-1.34 6.5-3z" id="Shape"></path>
                                <path fill="#f3d55b" d="m26 40c0 1.66-2.91 3-6.5 3s-6.5-1.34-6.5-3c0-1.25 1.65-2.32 4-2.77.8240637-.1564165 1.6612299-.2334358 2.5-.23 3.59 0 6.5 1.34 6.5 3z" id="Shape"></path>
                                <path fill="#f0c419" d="m26 40v13c0 1.66-2.91 3-6.5 3s-6.5-1.34-6.5-3v-13c0 1.66 2.91 3 6.5 3s6.5-1.34 6.5-3z" id="Shape"></path>
                                <path fill="#fdd7ad" d="m39 27c0 .5522847.4477153 1 1 1s1-.4477153 1-1c0-2.209139-1.790861-4-4-4v-1c0-.5522847-.4477153-1-1-1s-1 .4477153-1 1v1c-2.209139 0-4 1.790861-4 4s1.790861 4 4 4v4c-1.1045695 0-2-.8954305-2-2 0-.5522847-.4477153-1-1-1s-1 .4477153-1 1c0 2.209139 1.790861 4 4 4v1c0 .5522847.4477153 1 1 1s1-.4477153 1-1v-1c2.209139 0 4-1.790861 4-4s-1.790861-4-4-4v-4c1.1045695 0 2 .8954305 2 2zm0 6c0 1.1045695-.8954305 2-2 2v-4c1.1045695 0 2 .8954305 2 2zm-4-4c-1.1045695 0-2-.8954305-2-2s.8954305-2 2-2z" id="Shape"></path>
                            </g>
                        </g>
                    </svg>
                    <h5 class="card-title">Financial Aids</h5>
                    <p class="card-text">Manage your financial aid applications here.</p>
                    <a href="showRequests.php?userID=<?= $userID ?>&FacID=<?= $userInfo[0]['FacultyID'] ?>" class="btn btn-success btn-block">Track Submitted</a>
                    <button data-toggle="modal" data-target="#financialAidModal" class="btn btn-outline-success btn-block">Submit New</button>
                </div>
            </div>
        </div>

        <!-- Attestation Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); border: 1px solid purple;">
                <div class="card-body text-center">
                    <span class="folderContainer">
                        <svg
                            class="fileBack"
                            width="146"
                            height="113"
                            viewBox="0 0 146 113"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0 4C0 1.79086 1.79086 0 4 0H50.3802C51.8285 0 53.2056 0.627965 54.1553 1.72142L64.3303 13.4371C65.2799 14.5306 66.657 15.1585 68.1053 15.1585H141.509C143.718 15.1585 145.509 16.9494 145.509 19.1585V109C145.509 111.209 143.718 113 141.509 113H3.99999C1.79085 113 0 111.209 0 109V4Z"
                                fill="url(#paint0_linear_117_4)"></path>
                            <defs>
                                <linearGradient
                                    id="paint0_linear_117_4"
                                    x1="0"
                                    y1="0"
                                    x2="72.93"
                                    y2="95.4804"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#8F88C2"></stop>
                                    <stop offset="1" stop-color="#5C52A2"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                        <svg
                            class="filePage"
                            width="88"
                            height="99"
                            viewBox="0 0 88 99"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="88" height="99" fill="url(#paint0_linear_117_6)"></rect>
                            <defs>
                                <linearGradient
                                    id="paint0_linear_117_6"
                                    x1="0"
                                    y1="0"
                                    x2="81"
                                    y2="160.5"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white"></stop>
                                    <stop offset="1" stop-color="#686868"></stop>
                                </linearGradient>
                            </defs>
                        </svg>

                        <svg
                            class="fileFront"
                            width="160"
                            height="79"
                            viewBox="0 0 160 79"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.29306 12.2478C0.133905 9.38186 2.41499 6.97059 5.28537 6.97059H30.419H58.1902C59.5751 6.97059 60.9288 6.55982 62.0802 5.79025L68.977 1.18034C70.1283 0.410771 71.482 0 72.8669 0H77H155.462C157.87 0 159.733 2.1129 159.43 4.50232L150.443 75.5023C150.19 77.5013 148.489 79 146.474 79H7.78403C5.66106 79 3.9079 77.3415 3.79019 75.2218L0.29306 12.2478Z"
                                fill="url(#paint0_linear_117_5)"></path>
                            <defs>
                                <linearGradient
                                    id="paint0_linear_117_5"
                                    x1="38.7619"
                                    y1="8.71323"
                                    x2="66.9106"
                                    y2="82.8317"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#C3BBFF"></stop>
                                    <stop offset="1" stop-color="#51469A"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                    <h5 class="card-title">Attestations</h5>
                    <p class="card-text">Manage your Attestations here.</p>
                    <a  href="showRequests.php?userID=<?= $userID ?>&FacID=<?= $userInfo[0]['FacultyID'] ?>" class="btn btn-block fst text-white">Track Submitted</a>
                    <button data-toggle="modal" data-target="#attestationModal" class="btn  btn-block scd text-purple">Submit New</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Attestation Modal -->
<div class="modal fade" id="attestationModal" tabindex="-1" role="dialog" aria-labelledby="attestationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attestationModalLabel">Submit Attestation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="attestationDocument">Upload Attestation Document</label>
                        <input type="file" class="form-control-file" id="attestationDocument" name="attestationDocument[]" required>
                    </div>
                    <div class="form-group">
                        <label for="attestationComments">Comments</label>
                        <textarea class="form-control" id="attestationComments" name="comments" rows="3"></textarea>
                    </div>

                    <input name="FacID" value="<?= $userInfo[0]['FacultyID'] ?>" hidden>
                    <input name="StudentID" value="<?= $userID ?>" hidden>
                    <input name="reqType" value="Attestation" hidden>
                    <button type="submit" class="btn text-white" style="background-color:purple;">Submit Attestation</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Financial Aid Modal -->
<div class="modal fade" id="financialAidModal" tabindex="-1" role="dialog" aria-labelledby="financialAidModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="financialAidModalLabel">Submit Financial Aid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="financialAidDocument">Upload Financial Aid Document</label>
                        <input type="file" class="form-control-file" id="financialAidDocument" name="financialAidDocument[]" required>
                    </div>
                    <div class="form-group">
                        <label for="financialAidComments">Comments</label>
                        <textarea class="form-control" id="financialAidComments" name="comments" rows="3"></textarea>
                    </div>

                    <input name="FacID" value="<?= $userInfo[0]['FacultyID'] ?>" hidden>
                    <input name="StudentID" value="<?= $userID ?>" hidden>
                    <input name="reqType" value="FA" hidden>
                    <button type="submit" class="btn btn-success">Submit Financial Aid</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Petition Modal -->
<div class="modal fade" id="petitionModal" tabindex="-1" role="dialog" aria-labelledby="petitionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="petitionModalLabel">Submit Petition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="petitionDocument">Upload Petition Document</label>
                        <input type="file" class="form-control-file" id="petitionDocument" name="petitionDocument[]" required>
                    </div>
                    <div class="form-group">
                        <label for="petitionComments">Comments</label>
                        <textarea class="form-control" id="petitionComments" name="comments" rows="3"></textarea>
                    </div>

                    <input name="FacID" value="<?= $userInfo[0]['FacultyID'] ?>" hidden>
                    <input name="StudentID" value="<?= $userID ?>" hidden>
                    <input name="reqType" value="Petition" hidden>
                    <button type="submit" class="btn btn-primary">Submit Petition</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php require_once("components/footer.php") ?>
<!-- Bootstrap JS, Popper.js (needed for Bootstrap) -->

<script>
    $(document).ready(function() {
        // Handle Attestation form submission
        $('#attestationModal form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'actions/submit_request.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Assuming PHP sends success message or error as part of the response
                    if (response.includes('success')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Attestation Submitted',
                            text: 'Your attestation has been successfully submitted.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Refresh the page on confirmation
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Submission Error',
                            text: response // Display error message from PHP response
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Submission Failed',
                        text: 'There was an issue submitting your attestation. Please try again.'
                    });
                }
            });
        });

        // Handle Financial Aid form submission
        $('#financialAidModal form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'actions/submit_request.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.includes('success')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Financial Aid Submitted',
                            text: 'Your financial aid request has been successfully submitted.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Refresh the page on confirmation
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Submission Error',
                            text: response // Display error message from PHP response
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Submission Failed',
                        text: 'There was an issue submitting your financial aid. Please try again.'
                    });
                }
            });
        });

        // Handle Petition form submission
        $('#petitionModal form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'actions/submit_request.php', // Update the URL to match your PHP script
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    try {
                        var jsonResponse = JSON.parse(response); // Parse JSON response

                        if (jsonResponse.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Petition Submitted',
                                text: jsonResponse.message
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload(); // Refresh the page on confirmation
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Submission Error',
                                text: jsonResponse.message // Display error message from PHP response
                            });
                        }
                    } catch (e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Response Error',
                            text: 'Invalid response from server.'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Submission Failed',
                        text: 'There was an issue submitting your petition. Please try again.'
                    });
                }
            });
        });

    });
</script>
</body>

</html>