import { Head, useForm } from "@inertiajs/react";
import classNames from "clsx";
import React, { useRef, useState } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";

const TwoFactorChallenge = () => {
    const [recovery, setRecovery] = useState(false);
    const form = useForm({
        code: "",
        recovery_code: "",
    });
    const recoveryCodeRef = useRef(null);
    const codeRef = useRef(null);

    const toggleRecovery = (e) => {
        e.preventDefault();
        const isRecovery = !recovery;
        setRecovery(isRecovery);

        setTimeout(() => {
            if (isRecovery) {
                recoveryCodeRef.current?.focus();
                form.setData("code", "");
            } else {
                codeRef.current?.focus();
                form.setData("recovery_code", "");
            }
        }, 100);
    };

    const onSubmit = (e) => {
        e.preventDefault();
        form.post(route("two-factor-challenge"));
    };

    return (
        <GuestLayout>
            <Head title="Two-Factor Confirmation" />

            <div className="mb-4 text-sm text-gray-600">
                {recovery
                    ? "Please confirm access to your account by entering one of your emergency recovery codes."
                    : "Please confirm access to your account by entering the authentication code provided by your authenticator application."}
            </div>

            <form onSubmit={onSubmit}>
                {recovery ? (
                    <div>
                        <InputLabel htmlFor="recovery_code">
                            Recovery Code
                        </InputLabel>
                        <TextInput
                            id="recovery_code"
                            type="text"
                            className="mt-1 block w-full"
                            value={form.data.recovery_code}
                            onChange={(e) =>
                                form.setData(
                                    "recovery_code",
                                    e.currentTarget.value,
                                )
                            }
                            ref={recoveryCodeRef}
                            autoComplete="one-time-code"
                        />
                        <InputError
                            className="mt-2"
                            message={form.errors.recovery_code}
                        />
                    </div>
                ) : (
                    <div>
                        <InputLabel htmlFor="code">Code</InputLabel>
                        <TextInput
                            id="code"
                            type="text"
                            inputMode="numeric"
                            className="mt-1 block w-full"
                            value={form.data.code}
                            onChange={(e) =>
                                form.setData("code", e.currentTarget.value)
                            }
                            autoFocus
                            autoComplete="one-time-code"
                            ref={codeRef}
                        />
                        <InputError
                            className="mt-2"
                            message={form.errors.code}
                        />
                    </div>
                )}

                <div className="mt-4 flex items-center justify-end">
                    <button
                        type="button"
                        className="cursor-pointer text-sm text-gray-600 underline hover:text-gray-900"
                        onClick={toggleRecovery}
                    >
                        {recovery
                            ? "Use an authentication code"
                            : "Use a recovery code"}
                    </button>

                    <PrimaryButton
                        className={classNames("ml-4", {
                            "opacity-25": form.processing,
                        })}
                        disabled={form.processing}
                    >
                        Log in
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
};

export default TwoFactorChallenge;
