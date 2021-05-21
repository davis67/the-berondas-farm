<div>
    <h3 class="text-lg leading-6 font-medium text-gray-900">
        Summary Report
    </h3>
    <div class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden  md:grid-cols-6">
        <div>
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Total Rabbits
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                            {{ $rabbits_count }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Bucks
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                            {{ $bucks }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Dam
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                            {{ $dam }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Sire
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                            {{ $sire }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Does
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                            {{ $does }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Kits
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                            {{ $kits }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
