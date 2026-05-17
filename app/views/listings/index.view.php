<?= loadPartial("head"); ?>

<!-- Job Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Jobs</div>

        <?php
            $kw = $keywords ?? ($_GET['keywords'] ?? '');
            $loc = $location ?? ($_GET['location'] ?? '');
        ?>

        <form method="GET" action="/listings" class="mb-4 flex flex-col md:flex-row gap-2 items-center justify-center">
            <input type="text" name="keywords" placeholder="Keywords" value="<?= htmlspecialchars($kw) ?>"
                class="px-4 py-2 border rounded w-full md:w-1/3" />
            <input type="text" name="location" placeholder="Location" value="<?= htmlspecialchars($loc) ?>"
                class="px-4 py-2 border rounded w-full md:w-1/3" />
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
                <a href="/listings" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">Clear</a>
            </div>
        </form>
        <?php if (empty($listings)): ?>
            <div class="text-center p-6">No job listings found.</div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <?php foreach ($listings as $job): ?>
                    <div class="rounded-lg shadow-md bg-white">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold"><?= htmlspecialchars($job->title) ?></h2>
                            <p class="text-gray-700 text-lg mt-2"><?= nl2br(htmlspecialchars($job->description)) ?></p>
                            <ul class="my-4 bg-gray-100 p-4 rounded">
                                <li class="mb-2"><strong>Salary:</strong> $<?= htmlspecialchars(number_format((float)$job->salary, 2)) ?></li>
                                <li class="mb-2"><strong>Location:</strong> <?= htmlspecialchars($job->city ?: $job->state ?: $job->address) ?></li>
                                <li class="mb-2"><strong>Tags:</strong> <?= htmlspecialchars($job->tags) ?></li>
                            </ul>
                            <a href="/listings/<?= htmlspecialchars($job->id) ?>"
                                class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                                Details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
</section>

<?= loadPartial("footer"); ?>